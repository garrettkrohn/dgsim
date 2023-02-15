<?php

namespace App\Service;

use App\Dto\Response\CourseResponseDto;
use App\Dto\Response\HoleSimResponseDto;
use App\Dto\Response\Transformer\CourseResponseDtoTransformer;
use App\Dto\Response\Transformer\HoleSimResponseDtoTransformer;
use App\Dto\Response\Transformer\TournamentResponseDtoTransformer;
use App\Entity\Course;
use App\Repository\CourseRepository;
use App\Repository\HoleRepository;
use App\Repository\TournamentRepository;

class TournamentService
{
    private TournamentRepository $tournamentRepository;
    private TournamentResponseDtoTransformer $transformer;
    private CourseRepository $courseRepository;
    private CourseResponseDtoTransformer $courseResponseDtoTransformer;
    private HoleRepository $holeRepository;
    private HoleSimResponseDtoTransformer $holeSimResponseDtoTransformer;

    /**
     * @param TournamentRepository $tournamentRepository
     * @param TournamentResponseDtoTransformer $transformer
     * @param CourseRepository $courseRepository
     * @param CourseResponseDtoTransformer $courseResponseDtoTransformer
     * @param HoleRepository $holeRepository
     * @param HoleSimResponseDtoTransformer $holeSimResponseDtoTransformer
     */
    public function __construct(TournamentRepository $tournamentRepository, TournamentResponseDtoTransformer $transformer, CourseRepository $courseRepository, CourseResponseDtoTransformer $courseResponseDtoTransformer, HoleRepository $holeRepository, HoleSimResponseDtoTransformer $holeSimResponseDtoTransformer)
    {
        $this->tournamentRepository = $tournamentRepository;
        $this->transformer = $transformer;
        $this->courseRepository = $courseRepository;
        $this->courseResponseDtoTransformer = $courseResponseDtoTransformer;
        $this->holeRepository = $holeRepository;
        $this->holeSimResponseDtoTransformer = $holeSimResponseDtoTransformer;
    }


    public function getAllTournaments()
    {
//        $tournaments = $this->tournamentRepository->findAll();
//        return $this->transformer->transformFromObjects($tournaments);

//        $course = $this->courseRepository->find(3);
//        return $this->courseResponseDtoTransformer->transformFromObject($course);
        $holes = $this->courseRepository->find(3);
        dump($holes);

    }
}