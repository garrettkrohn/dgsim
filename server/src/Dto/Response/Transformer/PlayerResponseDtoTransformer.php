<?php

namespace App\Dto\Response\Transformer;

use App\Dto\Response\PlayerResponseDto;
use App\Entity\Player;

class PlayerResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    /**
     * @param Player $player
     * @return PlayerResponseDto
     */
    public function transformFromObject($player): PlayerResponseDto
    {
        $dto = new PlayerResponseDto();
        $dto->id = $player->getId();
        $dto->first_name = $player->getFirstName();
        $dto->last_name = $player->getLastName();
        $dto->putt_skill = $player->getPuttSkill();
        $dto->throw_power_skill = $player->getThrowPowerSkill();
        $dto->throw_accuracy_skill = $player->getThrowAccuracySkill();
        $dto->scramble_skill = $player->getScrambleSkill();
        $dto->start_season = $player->getStartSeason();
        $dto->is_active = $player->isIsActive();
        $dto->banked_skill_points = $player->getBankedSkillPoints();
//        $dto->archetype = $player->getArchetype();

        return $dto;
    }

}