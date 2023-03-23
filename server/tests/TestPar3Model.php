<?php

namespace App\Tests;

use App\Dto\Outgoing\HoleResultDto;
use App\Dto\Outgoing\HoleSimResponseDto;
use App\Dto\Outgoing\SimulationChanceDto;
use App\Repository\HoleResultRepository;
use App\Service\HoleResultService;
use App\Service\HoleService;
use App\Service\Simulation\BaseModel;
use App\Service\Simulation\Par3Model;
use App\Service\Simulation\PlayerHoleObject;
use App\Service\Simulation\PlayerSimulationObject;
use GuzzleHttp\Client;
use Monolog\Test\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class TestPar3Model extends TestCase
{
    private Par3ModelTest $par3Model;

    protected function setUp(): void
    {
        $this->par3Model = new Par3ModelTest(
            $this->getMockBuilder(HoleResultService::class)
                ->disableOriginalConstructor()
                ->getMock()
        );
    }

    public function testAverageObjects()
    {
        $playerSimObject = new PlayerSimulationObject(
            0,
            .5,
            .5,
            .5,
            .5,
            .5,
            .5,
            .5,
            .5,
            .5,
        );

        $holeSimObject = new HoleSimResponseDto();
        $holeSimObject->setCourseId(1);
        $holeSimObject->setPar(3);
        $holeSimObject->setParked(.5);
        $holeSimObject->setC1(.5);
        $holeSimObject->setC2(.5);
        $holeSimObject->setScramble(.5);

        $baseModel = new BaseModel();
        $result = $baseModel->averageObjects($playerSimObject, $holeSimObject);

        $expectedResult = new PlayerHoleObject(.5, .5, .5, .5, .5, .5, .5, .5, .5);
        self::assertEquals($result, $expectedResult);
    }

    public function testOddsOfResults()
    {
        $playerHoleSim = new PlayerHoleObject(
            .5,
            .5,
            .01,
            .15,
            .15,
            .01,
            .15,
            .15,
            .5,
        );

        $expectedResult = new SimulationChanceDto();
        $expectedResult->setResultId0(0.0001);
        $expectedResult->setResultId1(0.0099);
        $expectedResult->setResultId2(0.075);
        $expectedResult->setResultId3(0.0375);
        $expectedResult->setResultId4(0.01875);
        $expectedResult->setResultId5(0.01875);
        $expectedResult->setResultId6(0.075);
        $expectedResult->setResultId7(0.0375);
        $expectedResult->setResultId8(0.01875);
        $expectedResult->setResultId9(0.01875);
        $expectedResult->setResultId10(0.345);
        $expectedResult->setResultId11(0.1725);
        $expectedResult->setResultId12(0.1725);

        $result = $this->par3Model->oddsOfResults($playerHoleSim);

        self::assertEquals($result, $expectedResult);
    }

//    public function testGetHoleResultPar3()
//    {
//        $rng = 0;
//
//        $simChance = new SimulationChanceDto();
//        $simChance->setResultId0(0.0001);
//        $simChance->setResultId1(0.0099);
//        $simChance->setResultId2(0.075);
//        $simChance->setResultId3(0.0375);
//        $simChance->setResultId4(0.01875);
//        $simChance->setResultId5(0.01875);
//        $simChance->setResultId6(0.075);
//        $simChance->setResultId7(0.0375);
//        $simChance->setResultId8(0.01875);
//        $simChance->setResultId9(0.01875);
//        $simChance->setResultId10(0.345);
//        $simChance->setResultId11(0.1725);
//        $simChance->setResultId12(0.1725);
//
//        $result = $this->par3Model->getHoleResult(0, $simChance);
//        $expectedResult = new HoleResultDto();
//        $expectedResult->setScore(5);
//        $expectedResult->setC1Putts(2);
//        $expectedResult->setC2Putts(0);
//        $expectedResult->setParked(false);
//        $expectedResult->setC1InRegulation(false);
//        $expectedResult->setC2InRegulation(false);
//        $expectedResult->setScramble(false);
//        $expectedResult->setLuck(0);
////        $expectedResult = $this->holeResultService->buildHoleResult(5,2,0,false,false,false,false, 0);
//
//        self::assertEquals($result, $expectedResult);
//
//    }
}

class Par3ModelTest extends Par3Model
{
    public function __construct(HoleResultService $holeResultService)
    {
        parent::__construct($holeResultService);
    }
}