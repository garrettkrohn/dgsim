<?php

namespace App\Service\Simulation;

use App\Dto\Response\leaderboardDto;
use App\Dto\Response\Transformer\PlayerResponseDtoTransformer;
use App\Entity\PlayerTournament;
use App\Entity\Tournament;
use App\Repository\PlayerTournamentRepository;
use App\Repository\TournamentRepository;
use App\Service\CourseService;
use App\Service\HoleService;
use App\Service\PlayerService;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\HttpFoundation\Request;

class TournamentBuilder
{
    private CourseService $courseService;
    private PlayerService $playerService;
    private HoleService $holeService;
    private SimulationIterators $iterators;
    private TournamentRepository $tournamentRepository;
    private PlayerTournamentRepository $playerTournamentRepository;
    private EntityManagerInterface $entityManager;
    private PlayerResponseDtoTransformer $playerResponseDtoTransformer;

    public function __construct(CourseService $courseService, PlayerService $playerService, HoleService $holeService, SimulationIterators $iterators, TournamentRepository $tournamentRepository, PlayerTournamentRepository $playerTournamentRepository, EntityManagerInterface $entityManager, PlayerResponseDtoTransformer $playerResponseDtoTransformer)
    {
        $this->courseService = $courseService;
        $this->playerService = $playerService;
        $this->holeService = $holeService;
        $this->iterators = $iterators;
        $this->tournamentRepository = $tournamentRepository;
        $this->playerTournamentRepository = $playerTournamentRepository;
        $this->entityManager = $entityManager;
        $this->playerResponseDtoTransformer = $playerResponseDtoTransformer;
    }


    public function buildTournament(Request $request): Tournament
    {
        $tournamentRequest = json_decode($request->getContent(), true);
        $tournament = new Tournament();
        $tournament->setName($tournamentRequest['tournamentName']);
        $courseId = $tournamentRequest['courseId'];
        $course = $this->courseService->getCourseById($courseId);
        $tournament->setCourse($course);
        $tournament->setSeason($tournamentRequest['season']);
        $numberOfRounds = $tournamentRequest['numberOfRounds'];

        $allPlayerSimObjects = $this->playerService->getActivePlayerSimObjects();
        $allPlayers = $this->playerService->getAllActivePlayerEntities();

        $allHolesSimObjects = $this->holeService->getAllSimHoles($courseId);
        $allHoles = $this->holeService->getAllHolesByCourseId($courseId);

        $tournamentResponse = $this->iterators->playerIterator($allPlayerSimObjects,
            $allHolesSimObjects, $numberOfRounds, $tournament, $allHoles, $allPlayers);

        return $tournamentResponse;
    }

    public function buildLeaderboard(int $tournamentId):array
    {
        $tournament = $this->tournamentRepository->findOneBy(['tournament_id' => $tournamentId]);
        $playerTournaments = $tournament->getPlayerTournament();

        $leaderboard = [];
        foreach($playerTournaments as $pt) {
            $leaderboardPlayer = new leaderboardDto();
            $leaderboardPlayer->score = $pt->getTotalScore();
            $leaderboardPlayer->playerTournamentId = $pt->getPlayerTournamentId();
            $leaderboard[] = $leaderboardPlayer;
        }

        usort($leaderboard, function($a, $b) {
            if ($a->score == $b->score) {
                return 0;
            }
            return ($a < $b) ? -1 : 1;
        });

        dump($leaderboard);

        $tiedForFirst = [];

        if ($leaderboard[0]->score == $leaderboard[1]->score) {
            $tiedForFirst = $this->checkTieForFirst($leaderboard);
        }


        for ($x = 0; $x < count($leaderboard); $x++) {
            $playerTournament = $this->playerTournamentRepository->findOneBy(['player_tournament_id' => $leaderboard[$x]->playerTournamentId]);
            $playerTournament->setPlace($x + 1);
            $playerTournament->setTourPoints(count($leaderboard) - $x);
        }
        $this->entityManager->flush();

        return $leaderboard;
    }

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

    public function testCheckTie(): array {
        $leaderboard = [];

        $lb1 = new leaderboardDto();
        $lb1->score = 200;
        $lb1->playerTournamentId = 1;
        $leaderboard[] = $lb1;

        $lb2 = new leaderboardDto();
        $lb2->score = 200;
        $lb2->playerTournamentId = 2;
        $leaderboard[] = $lb2;

        $lb3 = new leaderboardDto();
        $lb3->score = 205;
        $lb3->playerTournamentId = 3;
        $leaderboard[] = $lb3;

        $returnArray = $this->checkTieForFirst($leaderboard);
        return $returnArray;
    }

    /**
     * @param PlayerTournament[] $playerTournamentArray
     * @param Tournament $tournament
     * @return void
     */
    public function simulationPlayoff(iterable $playerTournamentArray, Tournament $tournament)
    {
        $playerArray = [];
        foreach ($playerTournamentArray as $playerTournament) {
            $playerArray[] = $playerTournament->getPlayer();
        }

        $playerSimArray = $this->playerResponseDtoTransformer->transformFromObjects($playerArray);
        $courseId = $tournament->getCourse()->getCourseId();
        $holeSimArray = $this->holeService->getAllHolesByCourseId($courseId);
        $allHoles = $tournament->getCourse()->getHoles();

        $this->iterators->playoffIterator($playerArray, $holeSimArray, $allHoles, $tournament);

    }
}