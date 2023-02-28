<?php

namespace App\Service\Simulation;

class PlayerHoleObject {
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
     * @param $c1x_putt
     * @param $c2_putt
     * @param $acc_parked
     * @param $acc_c1
     * @param $acc_c2
     * @param $pwr_parked
     * @param $pwr_c1
     * @param $pwr_c2
     * @param $scramble
     */
    public function __construct($c1x_putt, $c2_putt, $acc_parked, $acc_c1, $acc_c2, $pwr_parked, $pwr_c1, $pwr_c2, $scramble)
    {
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
     * @return mixed
     */
    public function getC1xPutt()
    {
        return $this->c1x_putt;
    }

    /**
     * @param mixed $c1x_putt
     */
    public function setC1xPutt($c1x_putt): void
    {
        $this->c1x_putt = $c1x_putt;
    }

    /**
     * @return mixed
     */
    public function getC2Putt()
    {
        return $this->c2_putt;
    }

    /**
     * @param mixed $c2_putt
     */
    public function setC2Putt($c2_putt): void
    {
        $this->c2_putt = $c2_putt;
    }

    /**
     * @return mixed
     */
    public function getAccParked()
    {
        return $this->acc_parked;
    }

    /**
     * @param mixed $acc_parked
     */
    public function setAccParked($acc_parked): void
    {
        $this->acc_parked = $acc_parked;
    }

    /**
     * @return mixed
     */
    public function getAccC1()
    {
        return $this->acc_c1;
    }

    /**
     * @param mixed $acc_c1
     */
    public function setAccC1($acc_c1): void
    {
        $this->acc_c1 = $acc_c1;
    }

    /**
     * @return mixed
     */
    public function getAccC2()
    {
        return $this->acc_c2;
    }

    /**
     * @param mixed $acc_c2
     */
    public function setAccC2($acc_c2): void
    {
        $this->acc_c2 = $acc_c2;
    }

    /**
     * @return mixed
     */
    public function getPwrParked()
    {
        return $this->pwr_parked;
    }

    /**
     * @param mixed $pwr_parked
     */
    public function setPwrParked($pwr_parked): void
    {
        $this->pwr_parked = $pwr_parked;
    }

    /**
     * @return mixed
     */
    public function getPwrC1()
    {
        return $this->pwr_c1;
    }

    /**
     * @param mixed $pwr_c1
     */
    public function setPwrC1($pwr_c1): void
    {
        $this->pwr_c1 = $pwr_c1;
    }

    /**
     * @return mixed
     */
    public function getPwrC2()
    {
        return $this->pwr_c2;
    }

    /**
     * @param mixed $pwr_c2
     */
    public function setPwrC2($pwr_c2): void
    {
        $this->pwr_c2 = $pwr_c2;
    }

    /**
     * @return mixed
     */
    public function getScramble()
    {
        return $this->scramble;
    }

    /**
     * @param mixed $scramble
     */
    public function setScramble($scramble): void
    {
        $this->scramble = $scramble;
    }


}