<?php

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class HoleResultDto
{
    #[NotNull]
    #[Type('int')]
    public int $score;

    #[NotNull]
    #[Type('int')]
    public int $c1_putts;

    #[NotNull]
    #[Type('int')]
    public int $c2_putts;

    #[NotNull]
    #[Type('bool')]
    public bool $parked;

    #[NotNull]
    #[Type('bool')]
    public bool $c1_in_regulation;

    #[NotNull]
    #[Type('bool')]
    public bool $c2_in_regulation;

    #[NotNull]
    #[Type('bool')]
    public bool $scramble;

    #[NotNull]
    #[Type('float')]
    public float $luck;

    #[NotNull]
    #[Type('int')]
    public int $par;

    /**
     * @return int
     */
    public function getPar(): int
    {
        return $this->par;
    }

    /**
     * @param int $par
     */
    public function setPar(int $par): void
    {
        $this->par = $par;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @param int $score
     */
    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    /**
     * @return int
     */
    public function getC1Putts(): int
    {
        return $this->c1_putts;
    }

    /**
     * @param int $c1_putts
     */
    public function setC1Putts(int $c1_putts): void
    {
        $this->c1_putts = $c1_putts;
    }

    /**
     * @return int
     */
    public function getC2Putts(): int
    {
        return $this->c2_putts;
    }

    /**
     * @param int $c2_putts
     */
    public function setC2Putts(int $c2_putts): void
    {
        $this->c2_putts = $c2_putts;
    }

    /**
     * @return bool
     */
    public function isParked(): bool
    {
        return $this->parked;
    }

    /**
     * @param bool $parked
     */
    public function setParked(bool $parked): void
    {
        $this->parked = $parked;
    }

    /**
     * @return bool
     */
    public function isC1InRegulation(): bool
    {
        return $this->c1_in_regulation;
    }

    /**
     * @param bool $c1_in_regulation
     */
    public function setC1InRegulation(bool $c1_in_regulation): void
    {
        $this->c1_in_regulation = $c1_in_regulation;
    }

    /**
     * @return bool
     */
    public function isC2InRegulation(): bool
    {
        return $this->c2_in_regulation;
    }

    /**
     * @param bool $c2_in_regulation
     */
    public function setC2InRegulation(bool $c2_in_regulation): void
    {
        $this->c2_in_regulation = $c2_in_regulation;
    }

    /**
     * @return bool
     */
    public function isScramble(): bool
    {
        return $this->scramble;
    }

    /**
     * @param bool $scramble
     */
    public function setScramble(bool $scramble): void
    {
        $this->scramble = $scramble;
    }

    /**
     * @return float
     */
    public function getLuck(): float
    {
        return $this->luck;
    }

    /**
     * @param float $luck
     */
    public function setLuck(float $luck): void
    {
        $this->luck = $luck;
    }


}