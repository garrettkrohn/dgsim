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

    /**
     * @param int $score
     * @param int $c1_putts
     * @param int $c2_putts
     * @param bool $parked
     * @param bool $c1_in_regulation
     * @param bool $c2_in_regulation
     * @param bool $scramble
     * @param float $luck
     */
    public function __construct(int $score, int $c1_putts, int $c2_putts, bool $parked,
                                bool $c1_in_regulation, bool $c2_in_regulation, bool $scramble, float $luck)
    {
        $this->score = $score;
        $this->c1_putts = $c1_putts;
        $this->c2_putts = $c2_putts;
        $this->parked = $parked;
        $this->c1_in_regulation = $c1_in_regulation;
        $this->c2_in_regulation = $c2_in_regulation;
        $this->scramble = $scramble;
        $this->luck = $luck;
    }
}