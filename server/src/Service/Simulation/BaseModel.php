<?php

namespace App\Service\Simulation;

use App\Service\HoleSimService;

class BaseModel {

    public function averageObjects($playerSimObject, $holeSimObject):PlayerHoleObject {
        $c1x_putt = $playerSimObject->c1x_putt;
        $c2_putt = $playerSimObject->c2_putt;
        $acc_parked = $this->averageOdd($playerSimObject->acc_parked, $holeSimObject->parked);
        $acc_c1 = $this->averageOdd($playerSimObject->acc_c1, $holeSimObject->c1);
        $acc_c2 = $this->averageOdd($playerSimObject->acc_c2, $holeSimObject->c2);
        $pwr_parked = $this->averageOdd($playerSimObject->pwr_parked, $holeSimObject->parked);
        $pwr_c1 = $this->averageOdd($playerSimObject->pwr_c1, $holeSimObject->c1);
        $pwr_c2 = $this->averageOdd($playerSimObject->pwr_c2, $holeSimObject->c2);
        $scramble = $this->averageOdd($playerSimObject->scramble, $holeSimObject->scramble);
        return new PlayerHoleObject($c1x_putt, $c2_putt, $acc_parked, $acc_c1, $acc_c2, $pwr_parked, $pwr_c1, $pwr_c2, $scramble);
    }

    public function averageOdd($playerNumber, $holeNumber): float {
        return (($playerNumber * 1) + ($holeNumber * 3)) / 4;
    }

    function rng():float {
        return rand(0,10000) /10000;
    }
}

