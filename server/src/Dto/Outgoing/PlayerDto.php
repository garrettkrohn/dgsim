<?php

declare(strict_types=1);

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class PlayerDto
{
    #[NotNull]
    #[Type('int')]
    public int $player_id;

    #[NotNull]
    #[Type('int')]
    public string $first_name;

    #[NotNull]
    #[Type('int')]
    public string $last_name;

    #[NotNull]
    #[Type('int')]
    public int $putt_skill;

    #[NotNull]
    #[Type('int')]
    public int $throw_power_skill;

    #[NotNull]
    #[Type('int')]
    public int $throw_accuracy_skill;

    #[NotNull]
    #[Type('int')]
    public int $scramble_skill;

    #[NotNull]
    #[Type('int')]
    public int $start_season;

    #[NotNull]
    #[Type('int')]
    public bool $is_active;

    #[NotNull]
    #[Type('int')]
    public int $banked_skill_points;

    #[NotNull]
    public ArchetypeResponseDto $archetype;
}