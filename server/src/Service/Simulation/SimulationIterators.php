<?php

namespace App\Service\Simulation;

use App\Dto\Response\HoleResultDto;
use App\Service\Simulation\baseModel;
use App\Service\Simulation\Par3Model;
use App\Service\Simulation\Par4Model;
use App\Service\Simulation\Par5Model;

class SimulationIterators {
    public function tournamentIterator($playerArray, $courseArray) {
        $tournamentRounds = 1;
        for ($x = 0; $x < $tournamentRounds; $x++) {
            $this->playerIterator($playerArray, $courseArray);
        }
    }

    public function playerIterator($playerArray, $courseArray) {
        $playerRounds = array();
        for ($x = 0; $x < count($playerArray); $x++) {
            $playerRounds[] = $this->holeIterator($playerArray[$x], $courseArray);

        }
        return $playerRounds;
    }

    public function holeIterator($player, $course):array
    {
        $roundResult = 0;
        $holeResults = array();
        for ($x = 0; $x < count($course); $x++) {
            $holeResult = $this->parSwitcher($player, $course[$x]);
            $holeResults[] = $holeResult;
        }
        return $holeResults;
    }
    function parSwitcher($player, $hole):HoleResultDto {
        $par3Model = new Par3Model();
        $par4Model = new Par4Model();
        $par5Model = new Par5Model();

        return match ($hole->par) {
            3 => $par3Model->simulate($player, $hole),
            4 => $par4Model->simulate($player, $hole),
            5 => $par5Model->simulate($player, $hole),
            default => -100,
        };
    }

}
