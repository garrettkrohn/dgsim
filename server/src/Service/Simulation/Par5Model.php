<?php

namespace App\Service\Simulation;

use App\Dto\Outgoing\HoleResultDto;
use App\Service\HoleResultService;

class Par5Model extends BaseModel
{
    private HoleResultService $holeResultService;

    /**
     * @param HoleResultService $holeResultService
     */
    public function __construct(HoleResultService $holeResultService)
    {
        $this->holeResultService = $holeResultService;
    }

    public function simulate($playerSimObject, $holeSimObject): HoleResultDto
    {
        $playerHoleAveragesObject = $this->averageObjects($playerSimObject, $holeSimObject);
        $oddsOfResultsArray = $this->oddsOfResults($playerHoleAveragesObject);
        $rng = $this->rng();
        return $this->getHoleResult($rng, $oddsOfResultsArray);
    }

    private function getHoleResult($rng, $oddsOfResultsArray): HoleResultDto
    {
        $benchmark = $oddsOfResultsArray->resultId12;
        if ($rng < $benchmark) {
            return $this->holeResultService->buildHoleResult(7, 2,0, false, false, false, false, $rng);
        }
        $benchmark += $oddsOfResultsArray->resultId11;
        if ($rng < $benchmark) {
            return $this->holeResultService->buildHoleResult(6, 2,0, false,false, false, false, $rng);
        }
        $benchmark += $oddsOfResultsArray->resultId10;
        if ($rng < $benchmark) {
            return $this->holeResultService->buildHoleResult(5, 1,0, false,false, false, true, $rng);
        }
        $benchmark += $oddsOfResultsArray->resultId9;
        if ($rng < $benchmark) {
            return $this->holeResultService->buildHoleResult(7, 3,1, false,false, true, false, $rng);
        }
        $benchmark += $oddsOfResultsArray->resultId8;
        if ($rng < $benchmark) {
            return $this->holeResultService->buildHoleResult(6, 2,1, false,false, true, false, $rng);
        }
        $benchmark += $oddsOfResultsArray->resultId7;
        if ($rng < $benchmark) {
            return $this->holeResultService->buildHoleResult(5, 1,1, false,false, true, false, $rng);
        }
        $benchmark += $oddsOfResultsArray->resultId6;
        if ($rng < $benchmark) {
            return $this->holeResultService->buildHoleResult(4, 0,1, false,false, true, false, $rng);
        }
        $benchmark += $oddsOfResultsArray->resultId5;
        if ($rng < $benchmark) {
            return $this->holeResultService->buildHoleResult(7, 4,0, false,true, true, false, $rng);
        }
        $benchmark += $oddsOfResultsArray->resultId4;
        if ($rng < $benchmark) {
            return $this->holeResultService->buildHoleResult(6, 3,0, false,true, true, false, $rng);
        }
        $benchmark += $oddsOfResultsArray->resultId3;
        if ($rng < $benchmark) {
            return $this->holeResultService->buildHoleResult(5, 2,0, false,true, true, false, $rng);
        }
        $benchmark += $oddsOfResultsArray->resultId2;
        if ($rng < $benchmark) {
            return $this->holeResultService->buildHoleResult(4, 1,0, false,true, true, false, $rng);
        }
        $benchmark += $oddsOfResultsArray->resultId1;
        if ($rng < $benchmark) {
            return $this->holeResultService->buildHoleResult(4, 1,0, true,true, true, false, $rng);
        }
        $benchmark += $oddsOfResultsArray->resultId0;
        if ($rng <= $benchmark) {
            return $this->holeResultService->buildHoleResult(3, 0,0, true,true, true, false, $rng);
        }
        else return $this->holeResultService->buildHoleResult(-1,-1,-1,false, false, false, false, $rng);
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