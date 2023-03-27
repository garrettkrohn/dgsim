<?php

namespace App\Tests;

use App\Dto\Outgoing\SimulationChanceDto;
use App\Service\Simulation\PlayerSimulationObject;
use Monolog\Test\TestCase;

class SimulationTest extends TestCase
{

    public function testGetHoleResultPar3()
    {
        $rng = 0;

        $chancesObject = new SimulationChanceDto();
        $chancesObject->setResultId0(0.0007);
        $chancesObject->setResultId1(0.0693);
        $chancesObject->setResultId2(0.209177);
        $chancesObject->setResultId3(0.01674216);
        $chancesObject->setResultId4(0.0013393728);
        $chancesObject->setResultId5(0.0001164672);
        $chancesObject->setResultId6(0.12576525);
        $chancesObject->setResultId7(0.18097297);
        $chancesObject->setResultId8(0.0144778376);
        $chancesObject->setResultId9(0.0012589424);
        $chancesObject->setResultId10(0.21948837625);
        $chancesObject->setResultId11(0.14771669385);
        $chancesObject->setResultId12(0.0128449299);

        self::assertEquals(
            $chancesObject->getResultId0() +
            $chancesObject->getResultId1() +
            $chancesObject->getResultId2() +
            $chancesObject->getResultId3() +
            $chancesObject->getResultId4() +
            $chancesObject->getResultId5() +
            $chancesObject->getResultId6() +
            $chancesObject->getResultId7() +
            $chancesObject->getResultId8() +
            $chancesObject->getResultId9() +
            $chancesObject->getResultId10() +
            $chancesObject->getResultId11() +
            $chancesObject->getResultId12(),
            1
        );

    }

}