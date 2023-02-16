<?php

namespace App\Service;

use App\Dto\Response\CourseResponseDto;
use App\Dto\Response\HoleSimResponseDto;
use App\Dto\Response\TournamentResponseDto;
use App\Dto\Response\Transformer\CourseResponseDtoTransformer;
use App\Dto\Response\Transformer\HoleSimResponseDtoTransformer;
use App\Dto\Response\Transformer\HoleResultResponseDtoTransformer;
use App\Dto\Response\Transformer\TournamentResponseDtoTransformer;
use App\Entity\Course;
use App\Entity\Tournament;
use App\Repository\CourseRepository;
use App\Repository\HoleRepository;
use App\Repository\TournamentRepository;

class TournamentService
{
    private TournamentRepository $tournamentRepository;
    private HoleResultResponseDtoTransformer $transformer;
    private TournamentResponseDtoTransformer $tournamentResponseDtoTransformer;

    /**
     * @param TournamentRepository $tournamentRepository
     * @param HoleResultResponseDtoTransformer $transformer
     * @param TournamentResponseDtoTransformer $tournamentResponseDtoTransformer
     */
    public function __construct(TournamentRepository $tournamentRepository, HoleResultResponseDtoTransformer $transformer, TournamentResponseDtoTransformer $tournamentResponseDtoTransformer)
    {
        $this->tournamentRepository = $tournamentRepository;
        $this->transformer = $transformer;
        $this->tournamentResponseDtoTransformer = $tournamentResponseDtoTransformer;
    }

    public function getAllTournaments(): iterable
    {
        $tournaments = $this->tournamentRepository->findAll();
        return $this->tournamentResponseDtoTransformer->transformFromObjects($tournaments);
    }

    public function getTournamentById(int $id): TournamentResponseDto
    {
        $tournament = $this->tournamentRepository->find($id);
        return $this->tournamentResponseDtoTransformer->transformFromObject($tournament);
    }
}