<?php

namespace App\Tests;

use App\Dto\Outgoing\HoleSimResponseDto;
use App\Dto\Outgoing\SimulationChanceDto;
use App\Repository\HoleResultRepository;
use App\Service\HoleResultService;
use App\Service\Simulation\BaseModel;
use App\Service\Simulation\Par3Model;
use App\Service\Simulation\PlayerHoleObject;
use App\Service\Simulation\PlayerSimulationObject;
use GuzzleHttp\Client;
use Monolog\Test\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class TestSimulation extends TestCase
{

    private TestPar3Model $par3Model;

    protected function setUp(): void
    {
        $this->par3Model = new TestPar3Model(
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
            .5,
            .5,
            .5,
            .5,
            .5,
            .5,
            .5,
        );

        $expectedResult = new SimulationChanceDto();
        $expectedResult->setResultId0(0.005);
        $expectedResult->setResultId1(0.495);
        $expectedResult->setResultId2(0.25);
        $expectedResult->setResultId3(0.125);
        $expectedResult->setResultId4(0.0625);
        $expectedResult->setResultId5(0.0625);
        $expectedResult->setResultId6(0.25);
        $expectedResult->setResultId7(0.125);
        $expectedResult->setResultId8(0.0625);
        $expectedResult->setResultId9(0.0625);
        $expectedResult->setResultId10(0);
        $expectedResult->setResultId11(0);
        $expectedResult->setResultId12(0);

//        /** @var Par3Model|MockObject $par3Model */
//        $par3Model = $this->createMock(Par3Model::class);
//        $result = $par3Model->oddsOfResults($playerHoleSim);

//        $stub = $this->createStub(Par3Model::class);
//        $result = $stub->method('oddsOfResults');

//        $this->getMockBuilder(Par3Model::class)
//            ->disableOriginalConstructor()
//            ->getMock();

        $result = $this->par3Model->oddsOfResults($playerHoleSim);

        self::assertEquals($result, $expectedResult);
    }

//    public function testGetHoleResultPar3()
//    {
//        $rng = 0;
//
//        $chancesObject = new SimulationChanceDto();
//        $chancesObject->setResultId0(0.0007);
//        $chancesObject->setResultId1(0.0693);
//        $chancesObject->setResultId2(0.209177);
//        $chancesObject->setResultId3(0.01674216);
//        $chancesObject->setResultId4(0.0013393728);
//        $chancesObject->setResultId5(0.0001164672);
//        $chancesObject->setResultId6(0.12576525);
//        $chancesObject->setResultId7(0.18097297);
//        $chancesObject->setResultId8(0.0144778376);
//        $chancesObject->setResultId9(0.0012589424);
//        $chancesObject->setResultId10(0.21948837625);
//        $chancesObject->setResultId11(0.14771669385);
//        $chancesObject->setResultId12(0.0128449299);
//
//        self::assertEquals(
//            $chancesObject->getResultId0() +
//            $chancesObject->getResultId1() +
//            $chancesObject->getResultId2() +
//            $chancesObject->getResultId3() +
//            $chancesObject->getResultId4() +
//            $chancesObject->getResultId5() +
//            $chancesObject->getResultId6() +
//            $chancesObject->getResultId7() +
//            $chancesObject->getResultId8() +
//            $chancesObject->getResultId9() +
//            $chancesObject->getResultId10() +
//            $chancesObject->getResultId11() +
//            $chancesObject->getResultId12(),
//            1
//        );
//
//    }
}

class TestPar3Model extends Par3Model
{
    public function __construct(HoleResultService $holeResultService)
    {
        parent::__construct($holeResultService);
    }
}