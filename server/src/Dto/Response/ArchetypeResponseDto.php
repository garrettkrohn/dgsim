<?php

declare(strict_types=1);

namespace App\Dto\Response;

class ArchetypeResponseDto
{
    public int $id;
    public string $name;
    public int $min_putt_skill;
    public int $min_throw_power_skill;
    public int $min_throw_accuracy_skill;
    public int $min_scramble_skill;
    public int $max_putt_skill;
    public int $max_throw_power_skill;
    public int $max_throw_accuracy_skill;
    public int $max_scramble_skill;
}