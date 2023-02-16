<?php

namespace App\Dto\Response;

class HoleResultDto
{
    public int $score;
    public int $c1_putts;
    public int $c2_putts;
    public bool $parked;
    public bool $c1_in_regulation;
    public bool $c2_in_regulation;
    public bool $scramble;
    public float $luck;

}