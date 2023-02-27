<?php

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class HoleDto
{
    #[NotNull]
    #[Type('int')]
    private int $hole_id;

    #[NotNull]
    #[Type('int')]
    private int $course_id;

    #[NotNull]
    #[Type('int')]
    private int $par;

    #[NotNull]
    #[Type('float')]
    private float $parked_rate;

    #[NotNull]
    #[Type('float')]
    private float $c1_rate;

    #[NotNull]
    #[Type('float')]
    private float $c2_rate;

    #[NotNull]
    #[Type('float')]
    private float $scramble_rate;

    /**
     * @return int
     */
    public function getHoleId(): int
    {
        return $this->hole_id;
    }

    /**
     * @param int $hole_id
     */
    public function setHoleId(int $hole_id): void
    {
        $this->hole_id = $hole_id;
    }

    /**
     * @return int
     */
    public function getCourseId(): int
    {
        return $this->course_id;
    }

    /**
     * @param int $course_id
     */
    public function setCourseId(int $course_id): void
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
    public function getParkedRate(): float
    {
        return $this->parked_rate;
    }

    /**
     * @param float $parked_rate
     */
    public function setParkedRate(float $parked_rate): void
    {
        $this->parked_rate = $parked_rate;
    }

    /**
     * @return float
     */
    public function getC1Rate(): float
    {
        return $this->c1_rate;
    }

    /**
     * @param float $c1_rate
     */
    public function setC1Rate(float $c1_rate): void
    {
        $this->c1_rate = $c1_rate;
    }

    /**
     * @return float
     */
    public function getC2Rate(): float
    {
        return $this->c2_rate;
    }

    /**
     * @param float $c2_rate
     */
    public function setC2Rate(float $c2_rate): void
    {
        $this->c2_rate = $c2_rate;
    }

    /**
     * @return float
     */
    public function getScrambleRate(): float
    {
        return $this->scramble_rate;
    }

    /**
     * @param float $scramble_rate
     */
    public function setScrambleRate(float $scramble_rate): void
    {
        $this->scramble_rate = $scramble_rate;
    }



}