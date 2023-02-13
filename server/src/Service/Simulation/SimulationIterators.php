<?php

namespace App\Service\Simulation;

use App\Service\Simulation\baseModel;
use App\Service\Simulation\par3Model;
use App\Service\Simulation\par4Model;
use App\Service\Simulation\par5Model;

class SimulationIterators {
    public function tournamentIterator($playerArray, $courseArray) {
        $tournamentRounds = 1;
        for ($x = 0; $x < $tournamentRounds; $x++) {
            $this->playerIterator($playerArray, $courseArray);
        }
    }

    public function playerIterator($playerArray, $courseArray) {
        for ($x = 0; $x < count($playerArray); $x++) {
            echo "player $x || ";
            $this->holeIterator($playerArray[$x], $courseArray);
        }
    }

    public function holeIterator($player, $course) {
        $roundResult = 0;
        for ($x = 0; $x < count($course); $x++) {
            $holeResult = $this->parSwitcher($player, $course[$x]);
            $roundResult += $holeResult;
            echo "$holeResult | ";
        }
        echo "round total was $roundResult\n\n";
    }
    function parSwitcher($player, $hole):int {
        $par3Model = new par3Model();
        $par4Model = new par4Model();
        $par5Model = new par5Model();

        return match ($hole->par) {
            3 => $par3Model->simulate($player, $hole),
            4 => $par4Model->simulate($player, $hole),
            5 => $par5Model->simulate($player, $hole),
            default => -100,
        };
    }

}
