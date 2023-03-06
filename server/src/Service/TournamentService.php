<?php

namespace App\Service;

use App\Dto\Outgoing\TournamentResponseDto;
use App\Dto\Outgoing\TournamentTitlesDto;
use App\Dto\Outgoing\Transformer\TournamentResponseDtoTransformer;
use App\Entity\Tournament;
use App\Repository\TournamentRepository;
use Doctrine\ORM\EntityManagerInterface;

class TournamentService extends AbstractMultiTransformer
{
    private TournamentRepository $tournamentRepository;
    private EntityManagerInterface $entityManager;
    private CourseService $courseService;
    private PlayerTournamentService $playerTournamentService;

    /**
     * @param TournamentRepository $tournamentRepository
     * @param EntityManagerInterface $entityManager
     * @param CourseService $courseService
     * @param PlayerTournamentService $playerTournamentService
     */
    public function __construct(TournamentRepository $tournamentRepository, EntityManagerInterface $entityManager, CourseService $courseService, PlayerTournamentService $playerTournamentService)
    {
        $this->tournamentRepository = $tournamentRepository;
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

    public function deleteAllTournaments():string
    {
        $allTournaments = $this->tournamentRepository->findAll();
        foreach ($allTournaments as $tournament) {
            $this->entityManager->remove($tournament);
        }
        $this->entityManager->flush();
        return 'All tournaments deleted';
    }

    public function deleteTournamentById(int $id):string
    {
        $tournament = $this->tournamentRepository->find($id);
        $this->entityManager->remove($tournament);
        $this->entityManager->flush();
        return "deleted tournament with id: {$id}";
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
        $dto->setPlayerTournaments($this->playerTournamentService->transformFromObjects($object->getPlayerTournaments()));

        return $dto;
    }

    public function getAvailableSeasons(): array
    {
        $tournaments = $this->tournamentRepository->findAll();
        $returnArray = [];
        foreach ($tournaments as $tournament) {
            $returnArray[] = $tournament->getSeason();
        }
        $uniqueValues = array_unique($returnArray);
        return array_values($uniqueValues);
    }

    /**
     * @param int $id
     * @return TournamentResponseDto[] iterable
     */
    public function getTournamentsBySeason(int $id): iterable
    {
        $allTournaments = $this->tournamentRepository->findAll();
        $returnArray = [];
        foreach ($allTournaments as $tournament) {
            if ($tournament->getSeason() === $id) {
                $returnArray[] = $tournament;
            }
        }
        return $this->transformFromObjects($returnArray);
    }

    /**
     * @return TournamentTitlesDto[] iterable
     */
    public function getTournamentTitles(int $id): iterable
    {
        $allTournaments = $this->tournamentRepository->findBy(['season' => $id]);
        $returnArray = [];

        foreach ($allTournaments as $tournament) {
            $dto = new TournamentTitlesDto();
            $dto->setSeason($tournament->getSeason());
            $dto->setTournamentId($tournament->getTournamentId());
            $dto->setTournamentName($tournament->getName());
            $returnArray[] = $dto;
        }
        return $returnArray;
    }

}