<?php

namespace App\Service\Simulation;

class PlayerSimulationObject
{
    public int $player_id;
    public float $c1x_putt;
    public float $c2_putt;
    public float $acc_parked;
    public float $acc_c1;
    public float $acc_c2;
    public float $pwr_parked;
    public float $pwr_c1;
    public float $pwr_c2;
    public float $scramble;

    /**
     * @param int $player_id
     * @param float $c1x_putt
     * @param float $c2_putt
     * @param float $acc_parked
     * @param float $acc_c1
     * @param float $acc_c2
     * @param float $pwr_parked
     * @param float $pwr_c1
     * @param float $pwr_c2
     * @param float $scramble
     */
    public function __construct(int $player_id, float $c1x_putt, float $c2_putt, float $acc_parked, float $acc_c1, float $acc_c2, float $pwr_parked, float $pwr_c1, float $pwr_c2, float $scramble)
    {
        $this->player_id = $player_id;
        $this->c1x_putt = $c1x_putt;
        $this->c2_putt = $c2_putt;
        $this->acc_parked = $acc_parked;
        $this->acc_c1 = $acc_c1;
        $this->acc_c2 = $acc_c2;
        $this->pwr_parked = $pwr_parked;
        $this->pwr_c1 = $pwr_c1;
        $this->pwr_c2 = $pwr_c2;
        $this->scramble = $scramble;
    }

    /**
     * @return int
     */
    public function getPlayerId(): int
    {
        return $this->player_id;
    }

    /**
     * @param int $player_id
     */
    public function setPlayerId(int $player_id): void
    {
        $this->player_id = $player_id;
    }

    /**
     * @return float
     */
    public function getC1xPutt(): float
    {
        return $this->c1x_putt;
    }

    /**
     * @param float $c1x_putt
     */
    public function setC1xPutt(float $c1x_putt): void
    {
        $this->c1x_putt = $c1x_putt;
    }

    /**
     * @return float
     */
    public function getC2Putt(): float
    {
        return $this->c2_putt;
    }

    /**
     * @param float $c2_putt
     */
    public function setC2Putt(float $c2_putt): void
    {
        $this->c2_putt = $c2_putt;
    }

    /**
     * @return float
     */
    public function getAccParked(): float
    {
        return $this->acc_parked;
    }

    /**
     * @param float $acc_parked
     */
    public function setAccParked(float $acc_parked): void
    {
        $this->acc_parked = $acc_parked;
    }

    /**
     * @return float
     */
    public function getAccC1(): float
    {
        return $this->acc_c1;
    }

    /**
     * @param float $acc_c1
     */
    public function setAccC1(float $acc_c1): void
    {
        $this->acc_c1 = $acc_c1;
    }

    /**
     * @return float
     */
    public function getAccC2(): float
    {
        return $this->acc_c2;
    }

    /**
     * @param float $acc_c2
     */
    public function setAccC2(float $acc_c2): void
    {
        $this->acc_c2 = $acc_c2;
    }

    /**
     * @return float
     */
    public function getPwrParked(): float
    {
        return $this->pwr_parked;
    }

    /**
     * @param float $pwr_parked
     */
    public function setPwrParked(float $pwr_parked): void
    {
        $this->pwr_parked = $pwr_parked;
    }

    /**
     * @return float
     */
    public function getPwrC1(): float
    {
        return $this->pwr_c1;
    }

    /**
     * @param float $pwr_c1
     */
    public function setPwrC1(float $pwr_c1): void
    {
        $this->pwr_c1 = $pwr_c1;
    }

    /**
     * @return float
     */
    public function getPwrC2(): float
    {
        return $this->pwr_c2;
    }

    /**
     * @param float $pwr_c2
     */
    public function setPwrC2(float $pwr_c2): void
    {
        $this->pwr_c2 = $pwr_c2;
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