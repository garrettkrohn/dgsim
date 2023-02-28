<?php

namespace App\Service;

use App\Dto\Outgoing\RoundResponseDto;
use App\Entity\PlayerTournament;
use App\Entity\Round;
use App\Repository\RoundRepository;

class RoundService extends AbstractMultiTransformer
{
    private RoundRepository $roundRepository;
    private HoleResultService $holeResultService;

    /**
     * @param RoundRepository $roundRepository
     * @param HoleResultService $holeResultService
     */
    public function __construct(RoundRepository $roundRepository, HoleResultService $holeResultService)
    {
        $this->roundRepository = $roundRepository;
        $this->holeResultService = $holeResultService;
    }


    public function getAllRoundsByPTIdDto(int $id): iterable
    {
        $rounds = $this->roundRepository->findBy(['player_tournament' => $id]);
        return $this->transformFromObjects($rounds);
    }

    /**
     * @param Round $object
     * @return RoundResponseDto
     */
    public function transformFromObject($object): RoundResponseDto
    {
        $dto = new RoundResponseDto();
        $dto->setRoundId($object->getRoundId());
        $dto->setRoundTotal($object->getRoundTotal());
        $dto->setLuckScore($object->getLuckScore());
        $dto->setRoundType($object->getRoundType());
        $dto->setHoleresults($this->holeResultService->transformFromObjects($object->getHoleResults()));

        return $dto;
    }


}