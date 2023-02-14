<?php

namespace App\Service\Simulation;

use App\Dto\Response\HoleResultDto;
use App\Entity\HoleResult;
use App\Service\Simulation\baseModel;
use App\Service\Simulation\Par3Model;
use App\Service\Simulation\Par4Model;
use App\Service\Simulation\Par5Model;
use Doctrine\ORM\EntityManagerInterface;

class SimulationIterators {

    private Par3Model $par3Model;
    private Par4Model $par4Model;
    private Par5Model $par5Model;
    private EntityManagerInterface $entityManager;

    public function __construct(\App\Service\Simulation\Par3Model $par3Model, \App\Service\Simulation\Par4Model $par4Model, \App\Service\Simulation\Par5Model $par5Model, EntityManagerInterface $entityManager)
    {
        $this->par3Model = $par3Model;
        $this->par4Model = $par4Model;
        $this->par5Model = $par5Model;
        $this->entityManager = $entityManager;
    }


    public function roundIterator($playerArray, $courseArray) {
        $tournamentRounds = 1;
        for ($x = 0; $x < $tournamentRounds; $x++) {
            $this->playerIterator($playerArray, $courseArray);
        }
    }

    public function playerIterator($playerArray, $courseArray):array {
        $playerRounds = array();
        for ($x = 0; $x < count($playerArray); $x++) {
            $playerRounds[] = $playerArray[$x];
            //create round with player information

            $playerRounds[] = $this->holeIterator($playerArray[$x], $courseArray);

        }
        return $playerRounds;
    }

    public function holeIterator($player, $course):array
    {
        $holeResults = array();
        for ($x = 0; $x < count($course); $x++) {
            $holeResult = $this->parSwitcher($player, $course[$x]);
            $holeResults[] = $holeResult;
            $holePersist = $this->convertHoleResultDtoToHoleResults($holeResult);
            $this->entityManager->persist($holePersist);
            $this->entityManager->flush();
        }
        return $holeResults;
    }
    private function parSwitcher($player, $hole):HoleResultDto {

        return match ($hole->par) {
            3 => $this->par3Model->simulate($player, $hole),
            4 => $this->par4Model->simulate($player, $hole),
            5 => $this->par5Model->simulate($player, $hole),
            default => -100,
        };
    }

    private function convertHoleResultDtoToHoleResults(HoleResultDto $hole): HoleResult
    {
        $holeResult = new HoleResult();
        $holeResult->setScore($hole->score);
        $holeResult->setC1Putts($hole->c1_putts);
        $holeResult->setC2Putts($hole->c2_putts);
        $holeResult->setParked($hole->parked);
        $holeResult->setC1InRegulation($hole->c1_in_regulation);
        $holeResult->setC2InRegulation($hole->c2_in_regulation);
        $holeResult->setScramble($hole->scramble);

        return $holeResult;
    }
}
