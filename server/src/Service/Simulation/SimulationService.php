<?php

namespace App\Service\Simulation;

use App\Entity\Course;
use App\Repository\CourseRepository;
use App\Service\PlayerService;



class SimulationService
{
    private CourseRepository $courseRepository;
    private PlayerService $playerService;
    private PlayerIngester $playerIngester;

    public function __construct(CourseRepository $courseRepository, PlayerService $playerService, PlayerIngester $playerIngester)
    {
        $this->courseRepository = $courseRepository;
        $this->playerService = $playerService;
        $this->playerIngester = $playerIngester;
    }


    public function simulateTournament()
    {
        $allPlayerSimObjects = $this->getPlayerSimObjects();
        $course = $this->courseRepository->find(3);
        return $course;
    }

    public function getPlayerSimObjects(): iterable
    {
        $allActivePlayers = $this->playerService->getAllActivePlayers();

        $FLOOR_CEILING = new \stdClass();
        $FLOOR_CEILING->c1xFloorCeiling = [0.55, 0.92];
        $FLOOR_CEILING->c2FloorCeiling = [0.01, 0.39];
        $FLOOR_CEILING->parkedFloorCeiling = [0.01, 0.16];
        $FLOOR_CEILING->c1RegFloorCeiling = [0.16, 0.46];
        $FLOOR_CEILING->c2RegFloorCeiling = [0.29, 0.73];
        $FLOOR_CEILING->scrambleFloorCeiling = [0.14, 0.64];

        $allPlayersConverted = array();

        foreach($allActivePlayers as $player) {
            $allPlayersConverted[] = $this->playerIngester->convertPlayer($player,$FLOOR_CEILING);
        }

        return $allPlayersConverted;

    }



}