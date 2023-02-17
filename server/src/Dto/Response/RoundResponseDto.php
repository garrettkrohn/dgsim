<?php

namespace App\Dto\Response;

class RoundResponseDto
{
    public int $round_id;
    public iterable $holes;
    public int $round_total;
    public float $luck_score;
}