<?php

declare(strict_types=1);

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class PlayerDto
{
    #[NotNull]
    #[Type('int')]
    public int $playerId;

    #[NotNull]
    #[Type('int')]
    public string $firstName;

    #[NotNull]
    #[Type('int')]
    public string $lastName;

    #[NotNull]
    #[Type('int')]
    public int $puttSkill;

    #[NotNull]
    #[Type('int')]
    public int $throwPowerSkill;

    #[NotNull]
    #[Type('int')]
    public int $throwAccuracySkill;

    #[NotNull]
    #[Type('int')]
    public int $scrambleSkill;

    #[NotNull]
    #[Type('int')]
    public int $startSeason;

    #[NotNull]
    #[Type('int')]
    public bool $isActive;

    #[NotNull]
    #[Type('int')]
    public int $bankedSkillPoints;

    #[NotNull]
    public ArchetypeResponseDto $archetype;
}