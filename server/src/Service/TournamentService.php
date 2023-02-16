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
use Doctrine\ORM\EntityManagerInterface;

class TournamentService
{
    private TournamentRepository $tournamentRepository;
    private TournamentResponseDtoTransformer $tournamentResponseDtoTransformer;
    private EntityManagerInterface $entityManager;

    /**
     * @param TournamentRepository $tournamentRepository
     * @param TournamentResponseDtoTransformer $tournamentResponseDtoTransformer
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(TournamentRepository $tournamentRepository, TournamentResponseDtoTransformer $tournamentResponseDtoTransformer, EntityManagerInterface $entityManager)
    {
        $this->tournamentRepository = $tournamentRepository;
        $this->tournamentResponseDtoTransformer = $tournamentResponseDtoTransformer;
        $this->entityManager = $entityManager;
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

    public function deleteAllTournaments():void
    {
        $allTournaments = $this->tournamentRepository->findAll();
        foreach ($allTournaments as $tournament) {
            $this->entityManager->remove($tournament);
        }
        $this->entityManager->flush();
    }

    public function deleteTournamentById(int $id):void
    {
        $tournament = $this->tournamentRepository->find($id);
        $this->entityManager->remove($tournament);
        $this->entityManager->flush();
    }

}