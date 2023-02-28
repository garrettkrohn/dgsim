<?php

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class HoleSimResponseDto
{
    #[Type('int')]
    public ?int $course_id;

    #[NotNull]
    #[Type('int')]
    public int $par;

    #[NotNull]
    #[Type('float')]
    public float $parked;

    #[NotNull]
    #[Type('float')]
    public float $c1;

    #[NotNull]
    #[Type('float')]
    public float $c2;

    #[NotNull]
    #[Type('float')]
    public float $scramble;

    /**
     * @return int|null
     */
    public function getCourseId(): ?int
    {
        return $this->course_id;
    }

    /**
     * @param int|null $course_id
     */
    public function setCourseId(?int $course_id): void
    {
        $this->course_id = $course_id;
    }

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
    public function getParked(): float
    {
        return $this->parked;
    }

    /**
     * @param float $parked
     */
    public function setParked(float $parked): void
    {
        $this->parked = $parked;
    }

    /**
     * @return float
     */
    public function getC1(): float
    {
        return $this->c1;
    }

    /**
     * @param float $c1
     */
    public function setC1(float $c1): void
    {
        $this->c1 = $c1;
    }

    /**
     * @return float
     */
    public function getC2(): float
    {
        return $this->c2;
    }

    /**
     * @param float $c2
     */
    public function setC2(float $c2): void
    {
        $this->c2 = $c2;
    }

    /**
     * @return float
     */
    public function getScramble(): float
    {
        return $this->scramble;
    }

    /**
     * @param float $scramble
     */
    public function setScramble(float $scramble): void
    {
        $this->scramble = $scramble;
    }



}