<?php

namespace App\Dto\Request;

use App\Dto\Response\ArchetypeResponseDto;

class PlayerRequestDto
{
    public int $id;
    public string $first_name;
    public string $last_name;
    public int $putt_skill;
    public int $throw_power_skill;
    public int $throw_accuracy_skill;
    public int $scramble_skill;
    public int $start_season;
    public bool $is_active;
    public int $banked_skill_points;
    public ArchetypeResponseDto $archetype;
}