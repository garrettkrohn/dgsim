<?php

namespace App\Service\Simulation;

use App\Entity\Tournament;
use App\Service\CourseService;
use App\Service\HoleService;
use App\Service\PlayerService;
use Symfony\Component\HttpFoundation\Request;

class TournamentBuilder
{
    private CourseService $courseService;
    private PlayerService $playerService;
    private HoleService $holeService;
    private SimulationIterators $iterators;

    /**
     * @param CourseService $courseService
     * @param PlayerService $playerService
     * @param HoleService $holeService
     * @param SimulationIterators $iterators
     */
    public function __construct(CourseService $courseService, PlayerService $playerService, HoleService $holeService, SimulationIterators $iterators)
    {
        $this->courseService = $courseService;
        $this->playerService = $playerService;
        $this->holeService = $holeService;
        $this->iterators = $iterators;
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

        return $tournament;
    }
}