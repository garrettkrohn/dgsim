<?php

namespace App\Service\Simulation;

use App\Dto\Response\leaderboardDto;
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

    /**
     * @param CourseService $courseService
     * @param PlayerService $playerService
     * @param HoleService $holeService
     * @param SimulationIterators $iterators
     * @param TournamentRepository $tournamentRepository
     * @param PlayerTournamentRepository $playerTournamentRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(CourseService $courseService, PlayerService $playerService, HoleService $holeService,
                                SimulationIterators $iterators, TournamentRepository $tournamentRepository,
                                PlayerTournamentRepository $playerTournamentRepository,
                                EntityManagerInterface $entityManager)
    {
        $this->courseService = $courseService;
        $this->playerService = $playerService;
        $this->holeService = $holeService;
        $this->iterators = $iterators;
        $this->tournamentRepository = $tournamentRepository;
        $this->playerTournamentRepository = $playerTournamentRepository;
        $this->entityManager = $entityManager;
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
        $tournament = $this->tournamentRepository->findOneBy(array('tournament_id' => $tournamentId));
        $playerTournaments = $tournament->getPlayerTournament();

        $leaderboard = array();
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

        //check for ties, add the score to the leaderboard score maybe as a decimal, if it's a tie again add 0,
        // otherwise add .1 for the loser and 0 for the winner?

        for ($x = 0; $x < count($leaderboard); $x++) {
            $playerTournament = $this->playerTournamentRepository->findOneBy(array('player_tournament_id' => $leaderboard[$x]->playerTournamentId));
            $playerTournament->setPlace($x + 1);
            $playerTournament->setTourPoints(count($leaderboard) - $x);
        }
        $this->entityManager->flush();

        return $leaderboard;
    }
}