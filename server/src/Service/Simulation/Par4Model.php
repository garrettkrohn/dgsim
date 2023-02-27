<?php

namespace App\Service\Simulation;

use App\Dto\Outgoing\HoleResultDto;

class Par4Model extends BaseModel
{
    public function simulate($playerSimObject, $holeSimObject): HoleResultDto
    {
        $playerHoleAveragesObject = $this->averageObjects($playerSimObject, $holeSimObject);
        $oddsOfResultsArray = $this->oddsOfResults($playerHoleAveragesObject);
        $rng = $this->rng();
        return $this->getHoleResult($rng, $oddsOfResultsArray);
    }

    private function getHoleResult($rng, $oddsOfResultsArray): HoleResultDto
    {
        {
            $benchmark = $oddsOfResultsArray->resultId12;
            if ($rng < $benchmark) {
                return new HoleResultDto(6, 2,0, false, false, false, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->resultId11;
            if ($rng < $benchmark) {
                return new HoleResultDto(5, 2,0, false,false, false, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->resultId10;
            if ($rng < $benchmark) {
                return new HoleResultDto(4, 1,0, false,false, false, true, $rng);
            }
            $benchmark += $oddsOfResultsArray->resultId9;
            if ($rng < $benchmark) {
                return new HoleResultDto(6, 3,1, false,false, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->resultId8;
            if ($rng < $benchmark) {
                return new HoleResultDto(5, 2,1, false,false, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->resultId7;
            if ($rng < $benchmark) {
                return new HoleResultDto(4, 1,1, false,false, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->resultId6;
            if ($rng < $benchmark) {
                return new HoleResultDto(3, 0,1, false,false, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->resultId5;
            if ($rng < $benchmark) {
                return new HoleResultDto(6, 4,0, false,true, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->resultId4;
            if ($rng < $benchmark) {
                return new HoleResultDto(5, 3,0, false,true, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->resultId3;
            if ($rng < $benchmark) {
                return new HoleResultDto(4, 2,0, false,true, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->resultId2;
            if ($rng < $benchmark) {
                return new HoleResultDto(3, 1,0, false,true, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->resultId1;
            if ($rng < $benchmark) {
                return new HoleResultDto(3, 1,0, true,true, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->resultId0;
            if ($rng <= $benchmark) {
                return new HoleResultDto(2, 0,0, true,true, true, false, $rng);
            }
            else return new HoleResultDto(-1,-1,-1,false, false, false, false, $rng);
        }
    }

    //this is where I average the power and accuracy odds
    private function oddsOfResults($playerSimObject): object
    {
        $averageParked = ($playerSimObject->acc_parked + $playerSimObject->pwr_parked) / 2;
        $averageC1 = ($playerSimObject->acc_c1 + $playerSimObject->pwr_c1) / 2;
        $averageC2 = ($playerSimObject->acc_c2 + $playerSimObject->pwr_c2) / 2;

        $makec1 = $playerSimObject->c1x_putt;
        $missc1 = 1 - $makec1;
        $makec2 = $playerSimObject->c2_putt;
        $missc2 = 1 - $makec2;
        $missFairway = 1 - $playerSimObject->acc_parked - $playerSimObject->acc_c1 - $playerSimObject->acc_c2;

        $resultId0 = $averageParked * 0.1;
        $resultId1 = $averageParked * 0.9;
        $resultId2 = $averageC1 * $makec1;
        $resultId3 = $averageC1 * $missc1 * $makec1;
        $resultId4 = $averageC1 * $missc1 * $missc1 * $makec1;
        $resultId5 = $averageC1 * $missc1 * $missc1 * $missc1;
        $resultId6 = $averageC2 * $makec2;
        $resultId7 = $averageC2 * $missc2 * $makec1;
        $resultId8 = $averageC2 * $missc2 * $missc1 * $makec1;
        $resultId9 = $averageC2 * $missc2 * $missc1 * $missc1;
        $resultId10 = $missFairway * $playerSimObject->scramble;
        $resultId11 = $missFairway * (1 - $playerSimObject->scramble) * $makec1;
        $resultId12 = $missFairway * (1 - $playerSimObject->scramble) * $missc1;

        $chancesObject = new \stdClass();
        $chancesObject->resultId0 = $resultId0;
        $chancesObject->resultId1 = $resultId1;
        $chancesObject->resultId2 = $resultId2;
        $chancesObject->resultId3 = $resultId3;
        $chancesObject->resultId4 = $resultId4;
        $chancesObject->resultId5 = $resultId5;
        $chancesObject->resultId6 = $resultId6;
        $chancesObject->resultId7 = $resultId7;
        $chancesObject->resultId8 = $resultId8;
        $chancesObject->resultId9 = $resultId9;
        $chancesObject->resultId10 = $resultId10;
        $chancesObject->resultId11 = $resultId11;
        $chancesObject->resultId12 = $resultId12;

        return $chancesObject;
    }
}