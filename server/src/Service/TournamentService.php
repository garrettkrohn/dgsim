<?php

namespace App\Service;

use App\Dto\Outgoing\TournamentResponseDto;
use App\Dto\Outgoing\Transformer\TournamentResponseDtoTransformer;
use App\Entity\Tournament;
use App\Repository\TournamentRepository;
use Doctrine\ORM\EntityManagerInterface;

class TournamentService extends AbstractMultiTransformer
{
    private TournamentRepository $tournamentRepository;
    private TournamentResponseDtoTransformer $tournamentResponseDtoTransformer;
    private EntityManagerInterface $entityManager;
    private CourseService $courseService;
    private PlayerTournamentService $playerTournamentService;

    /**
     * @param TournamentRepository $tournamentRepository
     * @param TournamentResponseDtoTransformer $tournamentResponseDtoTransformer
     * @param EntityManagerInterface $entityManager
     * @param CourseService $courseService
     * @param PlayerTournamentService $playerTournamentService
     */
    public function __construct(TournamentRepository $tournamentRepository, TournamentResponseDtoTransformer $tournamentResponseDtoTransformer, EntityManagerInterface $entityManager, CourseService $courseService, PlayerTournamentService $playerTournamentService)
    {
        $this->tournamentRepository = $tournamentRepository;
        $this->tournamentResponseDtoTransformer = $tournamentResponseDtoTransformer;
        $this->entityManager = $entityManager;
        $this->courseService = $courseService;
        $this->playerTournamentService = $playerTournamentService;
    }


    public function getAllTournaments(): iterable
    {
        $tournaments = $this->tournamentRepository->findAll();
        return $this->transformFromObjects($tournaments);
    }

    public function getTournamentById(int $id): TournamentResponseDto
    {
        $tournament = $this->tournamentRepository->find($id);
        return $this->transformFromObject($tournament);
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

    /**
     * @param Tournament $object
     * @return TournamentResponseDto
     */
    public function transformFromObject($object): TournamentResponseDto
    {
        $dto = new TournamentResponseDto();
        $dto->setTournamentId($object->getTournamentId());
        $dto->setTournamentName($object->getName());
        $dto->setSeason($object->getSeason());
        $courseId = $object->getCourse()->getCourseId();
        $course = $this->courseService->getCourseByIdDto($courseId);
        $dto->setCourseResponseDto($course);
        $dto->setPlayerTournament($this->playerTournamentService->transformFromObjects($object->getPlayerTournaments()));

        return $dto;
    }


}