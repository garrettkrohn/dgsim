<?php

namespace App\Service\Simulation;

class Par3Model extends baseModel
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
        if ($rng < $oddsOfResultsArray->chanceOfFive) {
            return 5;
        } else if ($rng < $oddsOfResultsArray->chanceOfFour + $oddsOfResultsArray->chanceOfFive) {
            return 4;
        } else if ($rng < $oddsOfResultsArray->chanceOfThree + $oddsOfResultsArray->chanceOfFour + $oddsOfResultsArray->chanceOfFive) {
            return 3;
        } else if ($rng < $oddsOfResultsArray->chanceOfTwo + $oddsOfResultsArray->chanceOfThree + $oddsOfResultsArray->chanceOfFour + $oddsOfResultsArray->chanceOfFive) {
            return 2;
        } else {
            return 1;
        }
    }

    private function oddsOfResults($playerSimObject): object
    {
        $makec1 = $playerSimObject->c1x_putt;
        $missc1 = 1 - $makec1;
        $makec2 = $playerSimObject->c2_putt;
        $missc2 = 1 - $makec2;
        $missFairway = 1 - $playerSimObject->acc_parked - $playerSimObject->acc_c1 - $playerSimObject->acc_c2;

        $resultId0 = $playerSimObject->acc_parked * 0.01;
        $resultId1 = $playerSimObject->acc_parked * 0.99;
        $resultId2 = $playerSimObject->acc_c1 * $makec1;
        $resultId3 = $playerSimObject->acc_c1 * $missc1 * $makec1;
        $resultId4 = $playerSimObject->acc_c1 * $missc1 * $missc1 * $makec1;
        $resultId5 = $playerSimObject->acc_c1 * $missc1 * $missc1 * $missc1;
        $resultId6 = $playerSimObject->acc_c2 * $makec2;
        $resultId7 = $playerSimObject->acc_c2 * $missc2 * $makec1;
        $resultId8 = $playerSimObject->acc_c2 * $missc2 * $missc1 * $makec1;
        $resultId9 = $playerSimObject->acc_c2 * $missc2 * $missc1 * $missc1;
        $resultId10 = $missFairway * $playerSimObject->scramble;
        $resultId11 = $missFairway * (1 - $playerSimObject->scramble) * $makec1;
        $resultId12 = $missFairway * (1 - $playerSimObject->scramble) * $missc1;

        $chancesObject = new \stdClass();
        $chancesObject->chanceOfAce = $resultId0;
        $chancesObject->chanceOfTwo = $resultId1 + $resultId2 + $resultId6;
        $chancesObject->chanceOfThree = $resultId3 + $resultId7 + $resultId10;
        $chancesObject->chanceOfFour = $resultId4 + $resultId8 + $resultId11;
        $chancesObject->chanceOfFive = $resultId5 + $resultId9 + $resultId12;

        return $chancesObject;
    }
}