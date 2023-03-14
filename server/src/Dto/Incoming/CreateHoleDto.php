<?php

namespace App\Dto\Incoming;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class CreateHoleDto
{
    #[NotNull]
    #[Type('int')]
    public int $par;

    #[NotNull]
    #[Type('float')]
    public float $parkedRate;

    #[NotNull]
    #[Type('float')]
    public float $c1Rate;

    #[NotNull]
    #[Type('float')]
    public float $c2Rate;

    #[NotNull]
    #[Type('float')]
    public float $scrambleRate;

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
     * @return float
     */
    public function getParkedRate(): float
    {
        return $this->parkedRate;
    }

    /**
     * @param float $parkedRate
     */
    public function setParkedRate(float $parkedRate): void
    {
        $this->parkedRate = $parkedRate;
    }

    /**
     * @return float
     */
    public function getC1Rate(): float
    {
        return $this->c1Rate;
    }

    /**
     * @param float $c1Rate
     */
    public function setC1Rate(float $c1Rate): void
    {
        $this->c1Rate = $c1Rate;
    }

    /**
     * @return float
     */
    public function getC2Rate(): float
    {
        return $this->c2Rate;
    }

    /**
     * @param float $c2Rate
     */
    public function setC2Rate(float $c2Rate): void
    {
        $this->c2Rate = $c2Rate;
    }

    /**
     * @return float
     */
    public function getScrambleRate(): float
    {
        return $this->scrambleRate;
    }

    /**
     * @param float $scrambleRate
     */
    public function setScrambleRate(float $scrambleRate): void
    {
        $this->scrambleRate = $scrambleRate;
    }


}