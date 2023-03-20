<?php

namespace App\Service\Simulation;

class RoundCalculation {
  private PlayerSimulationObject $playerSimulationObject;
  private int $score;

    /**
     * @return PlayerSimulationObject
     */
    public function getPlayerSimulationObject(): PlayerSimulationObject
    {
        return $this->playerSimulationObject;
    }

    /**
     * @param PlayerSimulationObject $playerSimulationObject
     */
    public function setPlayerSimulationObject(PlayerSimulationObject $playerSimulationObject): void
    {
        $this->playerSimulationObject = $playerSimulationObject;
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


}