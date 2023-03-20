<?php

namespace App\Service\Simulation;

use App\Dto\Incoming\CreateTournamentDto;
use App\Dto\Outgoing\leaderboardDto;
use App\Entity\PlayerTournament;
use App\Entity\Round;
use App\Entity\Tournament;
use App\Repository\PlayerTournamentRepository;
use App\Repository\TournamentRepository;
use App\Service\CourseService;
use App\Service\HoleService;
use App\Service\HoleSimService;
use App\Service\PlayerService;
use Doctrine\ORM\EntityManagerInterface;

class TournamentBuilder
{
    private CourseService $courseService;
    private PlayerService $playerService;
    private HoleService $holeService;
    private SimulationIterators $iterators;
    private TournamentRepository $tournamentRepository;
    private PlayerTournamentRepository $playerTournamentRepository;
    private EntityManagerInterface $entityManager;
    private HoleSimService $holeSimService;

    /**
     * @param CourseService $courseService
     * @param PlayerService $playerService
     * @param HoleService $holeService
     * @param SimulationIterators $iterators
     * @param TournamentRepository $tournamentRepository
     * @param PlayerTournamentRepository $playerTournamentRepository
     * @param EntityManagerInterface $entityManager
     * @param HoleSimService $holeSimService
     */
    public function __construct(CourseService $courseService, PlayerService $playerService, HoleService $holeService,
                                SimulationIterators $iterators, TournamentRepository $tournamentRepository,
                                PlayerTournamentRepository $playerTournamentRepository,
                                EntityManagerInterface $entityManager, HoleSimService $holeSimService)
    {
        $this->courseService = $courseService;
        $this->playerService = $playerService;
        $this->holeService = $holeService;
        $this->iterators = $iterators;
        $this->tournamentRepository = $tournamentRepository;
        $this->playerTournamentRepository = $playerTournamentRepository;
        $this->entityManager = $entityManager;
        $this->holeSimService = $holeSimService;
    }

    public function buildTournament(CreateTournamentDto $createTournamentDto): Tournament
    {
        $tournament = new Tournament();
        $tournament->setName($createTournamentDto->getTournamentName());
        $courseId = $createTournamentDto->getCourseId();
        $course = $this->courseService->getCourseById($courseId);
        $tournament->setCourse($course);
        $tournament->setSeason($createTournamentDto->getSeason());
        $numberOfRounds = $createTournamentDto->getNumberOfRounds();

        $allPlayerSimObjects = $this->playerService->getActivePlayerSimObjects();
        $allPlayers = $this->playerService->getAllActivePlayerEntities();

        $allHolesSimObjects = $this->holeService->getAllSimHoles($courseId);
        $allHoles = $this->holeService->getAllHolesByCourseId($courseId);

        return  $this->iterators->playerIterator($allPlayerSimObjects,
            $allHolesSimObjects, $numberOfRounds, $tournament, $allHoles, $allPlayers);
    }

    /**Takes a tournament, assesses the leaderboard, updates the places on that tournament
     * It also runs playoff simulations, and includes those in the tournament
     *
     * @param int $tournamentId
     * @return array
     */
    public function buildLeaderboard(int $tournamentId):array
    {
        $tournament = $this->tournamentRepository->findOneBy(['tournament_id' => $tournamentId]);
        $playerTournaments = $tournament->getPlayerTournaments();

        $leaderboard = [];
        foreach($playerTournaments as $pt) {
            $leaderboardPlayer = new leaderboardDto();
            $leaderboardPlayer->setScore($pt->getTotalScore());
            $leaderboardPlayer->setPlayerTournament($pt);
            $leaderboard[] = $leaderboardPlayer;
        }

        usort($leaderboard, function($a, $b) {
            if ($a->score == $b->score) {
                return 0;
            }
            return ($a < $b) ? -1 : 1;
        });

        $place = 1;
        $numOfTies = 0;
        $tourPoints = count($leaderboard);
        for ($x = 0; $x < count($leaderboard); $x++) {
            if ($x === 0) {
                $playerTournament = $leaderboard[$x]->getPlayerTournament();
                $playerTournament->setPlace($place);
                $playerTournament->setTourPoints($tourPoints);
            } else if ($x > 0) {
                $previousPTScore = $leaderboard[$x-1];
                $currentPTScore = $leaderboard[$x];
                $playerTournament = $leaderboard[$x]->getPlayerTournament();
                if ($previousPTScore->getScore() === $currentPTScore->getScore()) {
                    $playerTournament->setPlace($place);
                    $playerTournament->setTourPoints($tourPoints);
                    $numOfTies += 1;
                } else {
                    $tourPoints -= 1;
                    $tourPoints -= $numOfTies;
                    $place += 1;
                    $place += $numOfTies;
                    $playerTournament->setPlace($place);
                    $playerTournament->setTourPoints($tourPoints);
                    $numOfTies = 0;
                }
            }
        }

        $this->entityManager->flush();

        $tiedForFirst = [];

        //if there is one tie, get others if there are any
        if ($leaderboard[0]->score == $leaderboard[1]->score) {
            $tiedForFirst = $this->checkTieForFirst($leaderboard);
            $playerTournaments = [];
            foreach($tiedForFirst as $dto) {
                $player = $this->playerService->getPlayer($dto->getPlayerTournament()->getPlayer()->getPlayerId());
                $playerTournaments[] = $this->playerTournamentRepository->
                findOneBy(['player' => $player, 'tournament' => $tournament]);
            }
            $this->simulationPlayoff($playerTournaments, $tournament);
        }

        return $leaderboard;
    }

    /**
     * @param leaderboardDto[] $leaderboardArray
     * @return leaderboardDto[]
     */
    public function checkTieForFirst(array $leaderboardArray): array {
        $tiedForFirst = [];
        $firstPlaceScore = $leaderboardArray[0]->score;

        foreach ($leaderboardArray as $leaderboardItem) {
            if ($leaderboardItem->score == $firstPlaceScore) {
                $tiedForFirst[] = $leaderboardItem;
            }
        }
        return $tiedForFirst;
    }

//    public function testCheckTie(): array {
//        $leaderboard = [];
//
//        $lb1 = new leaderboardDto();
//        $lb1->score = 200;
//        $lb1->playerTournamentId = 1;
//        $leaderboard[] = $lb1;
//
//        $lb2 = new leaderboardDto();
//        $lb2->score = 200;
//        $lb2->playerTournamentId = 2;
//        $leaderboard[] = $lb2;
//
//        $lb3 = new leaderboardDto();
//        $lb3->score = 205;
//        $lb3->playerTournamentId = 3;
//        $leaderboard[] = $lb3;
//
//        $returnArray = $this->checkTieForFirst($leaderboard);
//        return $returnArray;
//    }

    /**
     * @param PlayerTournament[] $playerTournamentArray
     * @param Tournament $tournament
     * @return void
     */
    public function simulationPlayoff(array $playerTournamentArray, Tournament $tournament): void
    {
        $playerArray = [];
        foreach ($playerTournamentArray as $playerTournament) {
            $player = $playerTournament->getPlayer();
            $playerArray[] = $player;
        }

        $playerDtoArray = $this->playerService->transformFromObjects($playerArray);
        $playerSimArray = $this->playerService->getPlayerSimObjects($playerDtoArray);
        $courseId = $tournament->getCourse()->getCourseId();
        $holeArray = $this->holeService->getAllHolesByCourseId($courseId);
        $holeSimArray = $this->holeSimService->transformFromObjects($holeArray);
        $allHoles = $tournament->getCourse()->getHoles();

        $tournamentWithPlayoff = $this->createPlayoffRounds($playerSimArray, $tournament);

        $this->iterators->playoffIterator($playerSimArray, $holeSimArray, $allHoles,
            $tournamentWithPlayoff);

    }
    /**
     * @param PlayerSimulationObject[] $playerArray
     * @param Tournament $tournament
     * @return Tournament
     */
    private function createPlayoffRounds(iterable $playerArray, Tournament $tournament):Tournament
    {
        $playerTournamentArray = [];
        foreach ($playerArray as $player) {
            $playoffRound = new Round();
            $playoffRound->setRoundTotal(0);
            $playoffRound->setLuckScore(0);
            $playoffRound->setRoundType('playoff');
            $playerTournament = $this->playerTournamentRepository->findOneBy(
                ['player' => $player->player_id, 'tournament' => $tournament->getTournamentId()]);
            $playerTournament->addRoundId($playoffRound);
            $tournament->addPlayerTournament($playerTournament);
//            $this->entityManager->persist($playerTournament);
        }
        return $tournament;
    }
}