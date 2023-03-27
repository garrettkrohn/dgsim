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
    public int $c1Putts;

    #[NotNull]
    #[Type('int')]
    public int $c2Putts;

    #[NotNull]
    #[Type('bool')]
    public bool $parked;

    #[NotNull]
    #[Type('bool')]
    public bool $c1InRegulation;

    #[NotNull]
    #[Type('bool')]
    public bool $c2InRegulation;

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
        return $this->c1Putts;
    }

    /**
     * @param int $c1Putts
     */
    public function setC1Putts(int $c1Putts): void
    {
        $this->c1Putts = $c1Putts;
    }

    /**
     * @return int
     */
    public function getC2Putts(): int
    {
        return $this->c2Putts;
    }

    /**
     * @param int $c2Putts
     */
    public function setC2Putts(int $c2Putts): void
    {
        $this->c2Putts = $c2Putts;
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
        return $this->c1InRegulation;
    }

    /**
     * @param bool $c1InRegulation
     */
    public function setC1InRegulation(bool $c1InRegulation): void
    {
        $this->c1InRegulation = $c1InRegulation;
    }

    /**
     * @return bool
     */
    public function isC2InRegulation(): bool
    {
        return $this->c2InRegulation;
    }

    /**
     * @param bool $c2InRegulation
     */
    public function setC2InRegulation(bool $c2InRegulation): void
    {
        $this->c2InRegulation = $c2InRegulation;
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