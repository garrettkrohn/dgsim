<?php

namespace App\Service\Simulation;

use App\Dto\Response\HoleResultDto;
use App\Dto\Response\Transformer\HoleResponseDtoTransformer;
use App\Entity\Course;
use App\Repository\CourseRepository;
use App\Repository\HoleRepository;
use App\Service\CourseService;
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
    private CourseService $courseService;
    private HoleService $holeService;

    public function __construct(CourseRepository $courseRepository, PlayerService $playerService, PlayerIngester $playerIngester, HoleRepository $holeRepository, HoleResponseDtoTransformer $transformer, SimulationIterators $iterators, CourseService $courseService, HoleService $holeService)
    {
        $this->courseRepository = $courseRepository;
        $this->playerService = $playerService;
        $this->playerIngester = $playerIngester;
        $this->holeRepository = $holeRepository;
        $this->transformer = $transformer;
        $this->iterators = $iterators;
        $this->courseService = $courseService;
        $this->holeService = $holeService;
    }


    public function simulateTournament(): iterable
    {
        //successfully converted all players to playersimobjects
        $allPlayerSimObjects = $this->playerService->getActivePlayerSimObjects();

        //hard coded for now
        $currentCourse = $this->courseService->getCourseById(3);
        $course = $this->courseRepository->find(3);

        //transform the holes
        $allHoles = $this->holeRepository->findAll();
        $transformedHoles = $this->transformer->transformFromObjects($allHoles);

        $holeResults = $this->iterators->playerIterator($allPlayerSimObjects, $transformedHoles);

        return $holeResults;
    }
}