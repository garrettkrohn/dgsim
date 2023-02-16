<?php

namespace App\Service;

use App\Dto\Response\CourseResponseDto;
use App\Dto\Response\HoleSimResponseDto;
use App\Dto\Response\TournamentResponseDto;
use App\Dto\Response\Transformer\CourseResponseDtoTransformer;
use App\Dto\Response\Transformer\HoleSimResponseDtoTransformer;
use App\Dto\Response\Transformer\PlayerTournamentResponseDtoTransformer;
use App\Entity\Course;
use App\Entity\Tournament;
use App\Repository\CourseRepository;
use App\Repository\HoleRepository;
use App\Repository\TournamentRepository;

class TournamentService
{
    private TournamentRepository $tournamentRepository;
    private PlayerTournamentResponseDtoTransformer $transformer;
    private CourseRepository $courseRepository;
    private CourseResponseDtoTransformer $courseResponseDtoTransformer;
    private HoleRepository $holeRepository;
    private HoleSimResponseDtoTransformer $holeSimResponseDtoTransformer;

    /**
     * @param TournamentRepository $tournamentRepository
     * @param PlayerTournamentResponseDtoTransformer $transformer
     * @param CourseRepository $courseRepository
     * @param CourseResponseDtoTransformer $courseResponseDtoTransformer
     * @param HoleRepository $holeRepository
     * @param HoleSimResponseDtoTransformer $holeSimResponseDtoTransformer
     */
    public function __construct(TournamentRepository $tournamentRepository, PlayerTournamentResponseDtoTransformer $transformer, CourseRepository $courseRepository, CourseResponseDtoTransformer $courseResponseDtoTransformer, HoleRepository $holeRepository, HoleSimResponseDtoTransformer $holeSimResponseDtoTransformer)
    {
        $this->tournamentRepository = $tournamentRepository;
        $this->transformer = $transformer;
        $this->courseRepository = $courseRepository;
        $this->courseResponseDtoTransformer = $courseResponseDtoTransformer;
        $this->holeRepository = $holeRepository;
        $this->holeSimResponseDtoTransformer = $holeSimResponseDtoTransformer;
    }


    public function getAllTournaments(): iterable
    {
        $tournaments = $this->tournamentRepository->findAll();
        return $this->transformer->transformFromObjects($tournaments);
    }

    public function getTournamentById(int $id): TournamentResponseDto
    {
        $tournament = $this->tournamentRepository->find($id);
        return $this->transformer->transformFromObject($tournament);
    }
}