<?php

namespace App\Dto\Outgoing;

class RoundResponseDto
{
    public int $round_id;
    public iterable $holes;
    public int $round_total;
    public float $luck_score;
    public string $round_type;
}