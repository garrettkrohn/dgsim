<?php

namespace App\Tests;

use App\Dto\Outgoing\FloorCeilingDto;
use App\Dto\Outgoing\PlayerDto;
use App\Entity\Player;
use App\Service\Simulation\PlayerIngester;
use App\Service\Simulation\PlayerSimulationObject;
use Monolog\Test\TestCase;

class TestPlayerIngester extends TestCase
{
    private PlayerIngesterTest $playerIngesterTest;

    protected function setUp(): void
    {
        $this->playerIngesterTest = new PlayerIngesterTest();
    }

    public function testConvertPlayerSkillToOdds(): void
    {
        $result = $this->playerIngesterTest->convertPlayerSkillToOdds(0, 1, 50);
        $expectedResult = .5;
        self::assertEquals($result, $expectedResult);
    }

}

class PlayerIngesterTest extends PlayerIngester
{
    public function __construct()
    {

    }
}