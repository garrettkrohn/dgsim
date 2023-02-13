<?php

namespace App\Service\Simulation;

use App\Dto\Response\HoleResultDto;
use App\Dto\Response\Transformer\HoleResponseDtoTransformer;
use App\Entity\Course;
use App\Repository\CourseRepository;
use App\Repository\HoleRepository;
use App\Service\HoleService;
use App\Service\PlayerService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class SimulationService
{
    private CourseRepository $courseRepository;
    private PlayerService $playerService;
    private PlayerIngester $playerIngester;
    private HoleRepository $holeRepository;
    private HoleResponseDtoTransformer $transformer;
    private SimulationIterators $iterators;

    public function __construct(CourseRepository $courseRepository, PlayerService $playerService, PlayerIngester $playerIngester, HoleRepository $holeRepository, HoleResponseDtoTransformer $transformer, SimulationIterators $iterators)
    {
        $this->courseRepository = $courseRepository;
        $this->playerService = $playerService;
        $this->playerIngester = $playerIngester;
        $this->holeRepository = $holeRepository;
        $this->transformer = $transformer;
        $this->iterators = $iterators;
    }


    public function simulateTournament(): iterable
    {
        //successfully converted all players to playersimobjects
        $allPlayerSimObjects = $this->getPlayerSimObjects();

        //hard coded for now
        $course = $this->courseRepository->find(3);

        //transform the holes
        $allHoles = $this->holeRepository->findAll();
        $transformedHoles = $this->transformer->transformFromObjects($allHoles);

        $holeResults = $this->iterators->playerIterator($allPlayerSimObjects, $transformedHoles);

        return $holeResults;
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