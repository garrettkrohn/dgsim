<?php

namespace App\Service\Simulation;

class Par5Model extends BaseModel
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
        if ($rng < $oddsOfResultsArray->chanceOfSeven) {
            return 7;
        } else if ($rng < $oddsOfResultsArray->chanceOfSix + $oddsOfResultsArray->chanceOfSeven) {
            return 6;
        } else if ($rng < $oddsOfResultsArray->chanceOfFive + $oddsOfResultsArray->chanceOfSix + $oddsOfResultsArray->chanceOfSeven) {
            return 5;
        } else if ($rng < $oddsOfResultsArray->chanceOfFour + $oddsOfResultsArray->chanceOfFive + $oddsOfResultsArray->chanceOfSix + $oddsOfResultsArray->chanceOfSeven) {
            return 4;
        } else {
            return 3;
        }
    }

    //this is where I average the power and accuracy odds
    private function oddsOfResults($playerSimObject): object
    {
        $makec1 = $playerSimObject->c1x_putt;
        $missc1 = 1 - $makec1;
        $makec2 = $playerSimObject->c2_putt;
        $missc2 = 1 - $makec2;
        $missFairway = 1 - $playerSimObject->acc_parked - $playerSimObject->acc_c1 - $playerSimObject->acc_c2;

        $resultId0 = $playerSimObject->pwr_parked * 0.2;
        $resultId1 = $playerSimObject->pwr_parked * 0.8;
        $resultId2 = $playerSimObject->pwr_c1 * $makec1;
        $resultId3 = $playerSimObject->pwr_c1 * $missc1 * $makec1;
        $resultId4 = $playerSimObject->pwr_c1 * $missc1 * $missc1 * $makec1;
        $resultId5 = $playerSimObject->pwr_c1 * $missc1 * $missc1 * $missc1;
        $resultId6 = $playerSimObject->pwr_c2 * $makec2;
        $resultId7 = $playerSimObject->pwr_c2 * $missc2 * $makec1;
        $resultId8 = $playerSimObject->pwr_c2 * $missc2 * $missc1 * $makec1;
        $resultId9 = $playerSimObject->pwr_c2 * $missc2 * $missc1 * $missc1;
        $resultId10 = $missFairway * $playerSimObject->scramble;
        $resultId11 = $missFairway * (1 - $playerSimObject->scramble) * $makec1;
        $resultId12 = $missFairway * (1 - $playerSimObject->scramble) * $missc1;

        $chancesObject = new \stdClass();
        $chancesObject->chanceOfThree = $resultId0;
        $chancesObject->chanceOfFour = $resultId1 + $resultId2 + $resultId6;
        $chancesObject->chanceOfFive = $resultId3 + $resultId7 + $resultId10;
        $chancesObject->chanceOfSix = $resultId4 + $resultId8 + $resultId11;
        $chancesObject->chanceOfSeven = $resultId5 + $resultId9 + $resultId12;

        return $chancesObject;
    }
}