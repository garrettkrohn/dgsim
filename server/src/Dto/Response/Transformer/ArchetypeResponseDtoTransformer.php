<?php

namespace App\Dto\Response\Transformer;

use App\Dto\Response\ArchetypeResponseDto;
use App\Entity\Archetype;

class ArchetypeResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    /**
     * @param Archetype $archetype
     * @return ArchetypeResponseDto
     */
    public function transformFromObject($archetype): ArchetypeResponseDto
    {
        $dto = new ArchetypeResponseDto();
        $dto->id = $archetype->getArchetypeId();
        $dto->name = $archetype->getName();
        $dto->min_putt_skill = $archetype->getMinPuttSkill();
        $dto->min_throw_power_skill = $archetype->getMinThrowPowerSkill();
        $dto->min_throw_accuracy_skill = $archetype->getMinThrowAccuracySkill();
        $dto->min_scramble_skill = $archetype->getMinScrambleSkill();
        $dto->max_putt_skill = $archetype->getMaxPuttSkill();
        $dto->max_throw_power_skill = $archetype->getMaxThrowPowerSkill();
        $dto->max_throw_accuracy_skill = $archetype->getMaxThrowAccuracySkill();
        $dto->max_scramble_skill = $archetype->getMaxScrambleSkill();

        return $dto;
    }

}