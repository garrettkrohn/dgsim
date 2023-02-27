<?php

namespace App\Dto\Outgoing\Transformer;

use App\Dto\Outgoing\PlayerTournamentResponseDto;
use App\Dto\Outgoing\RoundResponseDto;
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
        $dto->round_type = $object->getRoundType();
        $dto->holes = $this->holeResultResponseDtoTransformer->transformFromObjects($object->getHoleResults());

        return $dto;
    }

}