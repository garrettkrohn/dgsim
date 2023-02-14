<?php

namespace App\Service\Simulation;

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
    public function __construct(CourseService $courseService, PlayerService $playerService, HoleService $holeService, SimulationIterators $iterators, TournamentRepository $tournamentRepository, PlayerTournamentRepository $playerTournamentRepository, EntityManagerInterface $entityManager)
    {
        $this->courseService = $courseService;
        $this->playerService = $playerService;
        $this->holeService = $holeService;
        $this->iterators = $iterators;
        $this->tournamentRepository = $tournamentRepository;
        $this->playerTournamentRepository = $playerTournamentRepository;
        $this->entityManager = $entityManager;
    }

    public function buildTournament($request): Tournament
    {
        $tournamentRequest = json_decode($request->getContent(), true);
        $tournament = new Tournament();
        $tournament->setName('tourny');
        $courseId = 3;
        $course = $this->courseService->getCourseById($courseId);
        $tournament->setCourse($course);
        $tournament->setSeason(1);
        $numberOfRounds = 4;

        $allPlayerSimObjects = $this->playerService->getActivePlayerSimObjects();

        $allHolesSimObjects = $this->holeService->getAllSimHoles($courseId);

        $tournamentResponse = $this->iterators->playerIterator($allPlayerSimObjects,
            $allHolesSimObjects, $numberOfRounds, $tournament);

        return $tournamentResponse;
    }

    public function buildLeaderboard(int $tournamentId):array
    {
        $tournament = $this->tournamentRepository->findOneBy(array('tournament_id' => $tournamentId));
        $playerTournaments = $tournament->getPlayerTournament();

        $leaderboard = array();
        foreach($playerTournaments as $pt) {
            $leader = new \stdClass();
            $leader->score = $pt->getTotalScore();
            $leader->playerTournamentId = $pt->getPlayerTournamentId();
            $leaderboard[] = $leader;
        }

        usort($leaderboard, function($a, $b) {
            if ($a->score == $b->score) {
                return 0;
            }
            return ($a < $b) ? -1 : 1;
        });

        for ($x = 0; $x < count($leaderboard); $x++) {
            $playerTournament = $this->playerTournamentRepository->findOneBy(array('player_tournament_id' => $leaderboard[$x]->playerTournamentId));
            $playerTournament->setPlace($x + 1);
            $playerTournament->setTourPoints(count($leaderboard) - $x);
        }
        $this->entityManager->flush();

        return $leaderboard;
    }
}