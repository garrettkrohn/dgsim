<?php

namespace App\Dto\Response\Transformer;

use App\Dto\Response\PlayerTournamentResponseDto;
use App\Dto\Response\RoundResponseDto;
use App\Entity\PlayerTournament;
use App\Entity\Round;

class RoundResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    private HoleResultResponseDtoTransformer $holeResultResponseDtoTransformer;

    public function __construct(HoleResultResponseDtoTransformer $holeResultResponseDtoTransformer)
    {
        $this->holeResultResponseDtoTransformer = $holeResultResponseDtoTransformer;
    }

    /**
     * @param Round $object
     * @return RoundResponseDto
     */
    public function transformFromObject($object): RoundResponseDto
    {
        $dto = new RoundResponseDto();
        $dto->round_id = $object->getRoundId();
        $dto->round_total = $object->getRoundTotal();
        $dto->luck_score = $object->getLuckScore();
        $dto->holes = $this->holeResultResponseDtoTransformer->transformFromObjects($object->getHoleResults());

        return $dto;
    }

}