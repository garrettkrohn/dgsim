<?php

namespace App\Dto\Outgoing\Transformer;

use App\Dto\Outgoing\PlayerDto;
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
     * @return PlayerDto
     */
    public function transformFromObject($player): PlayerDto
    {

    }

}