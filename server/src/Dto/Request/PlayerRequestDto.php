<?php

namespace App\Dto\Request;

class PlayerRequestDto
{
    public string $first_name;
    public string $last_name;
    public int $putt_skill;
    public int $throw_power_skill;
    public int $throw_accuracy_skill;
    public int $scramble_skill;
    public int $start_season;
    public string $archetypeName;
}
