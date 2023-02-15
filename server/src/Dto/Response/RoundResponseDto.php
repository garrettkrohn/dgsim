<?php

namespace App\Dto\Response;

class RoundResponseDto
{
    public int $round_id;
    public HoleResultDto $holeResultDto;
    public int $round_total;
    public int $luck_score;

    public function __construct(int $round_id, HoleResultDto $holeResultDto, int $round_total, int $luck_score)
    {
        $this->round_id = $round_id;
        $this->holeResultDto = $holeResultDto;
        $this->round_total = $round_total;
        $this->luck_score = $luck_score;
    }


}