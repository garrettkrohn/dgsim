<?php

namespace App\Service\Simulation;

use App\Dto\Response\HoleResultDto;
use App\Entity\HoleResult;
use App\Entity\PlayerTournament;
use App\Entity\Round;
use App\Entity\Tournament;
use App\Service\Simulation\baseModel;
use App\Service\Simulation\Par3Model;
use App\Service\Simulation\Par4Model;
use App\Service\Simulation\Par5Model;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Expr\Math;
use phpDocumentor\Reflection\Types\Integer;

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

    public function playerIterator($playerArray, $courseArray, $numberOfRounds, Tournament $tournament): Tournament {
        for ($x = 0; $x < count($playerArray); $x++) {
            $playerTournamentReturn = $this->roundIterator($playerArray[$x], $courseArray, $numberOfRounds);
            $tournament->addPlayerTournament($playerTournamentReturn);
        }
        return $tournament;
    }

    public function roundIterator($player, $courseArray, $numberOfRounds):PlayerTournament {
        $playerTournament = new PlayerTournament();
        $tournamentTotal = 0;
        $luckTotal = 0;
        for ($x = 0; $x < $numberOfRounds; $x++) {
            $roundReturn = $this->holeIterator($player, $courseArray);
            $tournamentTotal += $roundReturn->getRoundTotal();
            $luckTotal += $roundReturn->getLuckScore();
            $playerTournament->addRoundId($roundReturn);
        }
        $playerTournament->setTotalScore($tournamentTotal);
        $playerTournament->setLuckScore($luckTotal/$numberOfRounds);
        $playerTournament->setTourPoints(0);
        return $playerTournament;
    }

    public function holeIterator($player, $course): Round
    {
        $round = new Round();
        $roundTotal = 0;
        $luckScore = 0;
        for ($x = 0; $x < count($course); $x++) {
            $holeResult = $this->parSwitcher($player, $course[$x]);
            $roundTotal += $holeResult->score;
            $luckScore += $holeResult->luck;
            $holePersist = $this->convertHoleResultDtoToHoleResults($holeResult, $round);
            $round->addHoleResult($holePersist);
        }
        $round->setRoundTotal($roundTotal);
        $totalLuckScore = $luckScore / count($course);
        $round->setLuckScore(round($totalLuckScore, 4, 1));
        return $round;
    }
    private function parSwitcher($player, $hole):HoleResultDto {

        return match ($hole->par) {
            3 => $this->par3Model->simulate($player, $hole),
            4 => $this->par4Model->simulate($player, $hole),
            5 => $this->par5Model->simulate($player, $hole),
            default => -100,
        };
    }

    private function convertHoleResultDtoToHoleResults(HoleResultDto $hole, Round $round): HoleResult
    {
        $holeResult = new HoleResult();
        $holeResult->setScore($hole->score);
        $holeResult->setC1Putts($hole->c1_putts);
        $holeResult->setC2Putts($hole->c2_putts);
        $holeResult->setParked($hole->parked);
        $holeResult->setC1InRegulation($hole->c1_in_regulation);
        $holeResult->setC2InRegulation($hole->c2_in_regulation);
        $holeResult->setScramble($hole->scramble);
        $holeResult->setRound($round);
        $holeResult->setLuck($hole->luck);

        return $holeResult;
    }
}
