<?php

namespace App\Service\Simulation;

use App\Dto\Outgoing\HoleResultDto;
use App\Dto\Outgoing\SimulationChanceDto;
use App\Service\HoleResultService;

class Par4Model extends BaseModel
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
        {
            $benchmark = $oddsOfResultsArray->getResultId12();
            if ($rng < $benchmark) {
                return $this->holeResultService->buildHoleResult(6, 2,0, false, false, false, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->getResultId11();
            if ($rng < $benchmark) {
                return $this->holeResultService->buildHoleResult(5, 2,0, false,false, false, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->getResultId10();
            if ($rng < $benchmark) {
                return $this->holeResultService->buildHoleResult(4, 1,0, false,false, false, true, $rng);
            }
            $benchmark += $oddsOfResultsArray->getResultId9();
            if ($rng < $benchmark) {
                return $this->holeResultService->buildHoleResult(6, 3,1, false,false, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->getResultId8();
            if ($rng < $benchmark) {
                return $this->holeResultService->buildHoleResult(5, 2,1, false,false, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->getResultId7();
            if ($rng < $benchmark) {
                return $this->holeResultService->buildHoleResult(4, 1,1, false,false, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->getResultId6();
            if ($rng < $benchmark) {
                return $this->holeResultService->buildHoleResult(3, 0,1, false,false, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->getResultId5();
            if ($rng < $benchmark) {
                return $this->holeResultService->buildHoleResult(6, 4,0, false,true, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->getResultId4();
            if ($rng < $benchmark) {
                return $this->holeResultService->buildHoleResult(5, 3,0, false,true, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->getResultId3();
            if ($rng < $benchmark) {
                return $this->holeResultService->buildHoleResult(4, 2,0, false,true, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->getResultId2();
            if ($rng < $benchmark) {
                return $this->holeResultService->buildHoleResult(3, 1,0, false,true, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->getResultId1();
            if ($rng < $benchmark) {
                return $this->holeResultService->buildHoleResult(3, 1,0, true,true, true, false, $rng);
            }
            $benchmark += $oddsOfResultsArray->getResultId0();
            if ($rng <= $benchmark) {
                return $this->holeResultService->buildHoleResult(2, 0,0, true,true, true, false, $rng);
            }
            else return $this->holeResultService->buildHoleResult(-1,-1,-1,false, false, false, false, $rng);
        }
    }

    //this is where I average the power and accuracy odds
    private function oddsOfResults($playerSimObject): SimulationChanceDto
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

        $chancesObject = new SimulationChanceDto();
        $chancesObject->setResultId0($resultId0);
        $chancesObject->setResultId1($resultId1);
        $chancesObject->setResultId2($resultId2);
        $chancesObject->setResultId3($resultId3);
        $chancesObject->setResultId4($resultId4);
        $chancesObject->setResultId5($resultId5);
        $chancesObject->setResultId6($resultId6);
        $chancesObject->setResultId7($resultId7);
        $chancesObject->setResultId8($resultId8);
        $chancesObject->setResultId9($resultId9);
        $chancesObject->setResultId10($resultId10);
        $chancesObject->setResultId11($resultId11);
        $chancesObject->setResultId12($resultId12);

        return $chancesObject;
    }
}