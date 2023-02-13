<?php

namespace App\Service\Simulation;

class Par4Model extends BaseModel
{
    public function simulate($playerSimObject, $holeSimObject): int
    {
        $playerHoleAveragesObject = $this->averageObjects($playerSimObject, $holeSimObject);
        $oddsOfResultsArray = $this->oddsOfResults($playerHoleAveragesObject);
        $rng = $this->rng();
        return $this->getHoleResult($rng, $oddsOfResultsArray);
    }

    private function getHoleResult($rng, $oddsOfResultsArray): int
    {
        if ($rng < $oddsOfResultsArray->chanceOfSix) {
            return 6;
        } else if ($rng < $oddsOfResultsArray->chanceOfFive + $oddsOfResultsArray->chanceOfSix) {
            return 5;
        } else if ($rng < $oddsOfResultsArray->chanceOfFour + $oddsOfResultsArray->chanceOfFive + $oddsOfResultsArray->chanceOfSix) {
            return 4;
        } else if ($rng < $oddsOfResultsArray->chanceOfThree + $oddsOfResultsArray->chanceOfFour + $oddsOfResultsArray->chanceOfFive + $oddsOfResultsArray->chanceOfSix) {
            return 3;
        } else {
            return 2;
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
        $chancesObject->chanceOfTwo = $resultId0;
        $chancesObject->chanceOfThree = $resultId1 + $resultId2 + $resultId6;
        $chancesObject->chanceOfFour = $resultId3 + $resultId7 + $resultId10;
        $chancesObject->chanceOfFive = $resultId4 + $resultId8 + $resultId11;
        $chancesObject->chanceOfSix = $resultId5 + $resultId9 + $resultId12;

        return $chancesObject;
    }
}