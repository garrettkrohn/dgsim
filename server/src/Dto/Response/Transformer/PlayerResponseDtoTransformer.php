<?php

namespace App\Dto\Response\Transformer;

use App\Dto\Response\PlayerResponseDto;
use App\Entity\Archetype;
use App\Entity\Player;

class PlayerResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    private ArchetypeResponseDtoTransformer $ArchetypeResponseDtoTransformer;

    public function __construct(
        ArchetypeResponseDtoTransformer $archetypeResponseDtoTransformer
    )
    {
        $this->ArchetypeResponseDtoTransformer = $archetypeResponseDtoTransformer;
    }

    /**
     * @param Player $player
     * @return PlayerResponseDto
     */
    public function transformFromObject($player): PlayerResponseDto
    {

    }

}