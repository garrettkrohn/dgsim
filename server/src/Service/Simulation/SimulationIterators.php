<?php

namespace App\Service\Simulation;

use App\Dto\Outgoing\HoleResultDto;
use App\Dto\Outgoing\HoleSimResponseDto;
use App\Dto\Outgoing\PlayerDto;
use App\Entity\Hole;
use App\Entity\HoleResult;
use App\Entity\Player;
use App\Entity\PlayerTournament;
use App\Entity\Round;
use App\Entity\Tournament;
use App\Repository\PlayerTournamentRepository;
use App\Repository\RoundRepository;
use Doctrine\ORM\EntityManagerInterface;

class SimulationIterators {

    private Par3Model $par3Model;
    private Par4Model $par4Model;
    private Par5Model $par5Model;
    private PlayerTournamentRepository $playerTournamentRepository;
    private EntityManagerInterface $entityManager;
    private RoundRepository $roundRepository;

    public function __construct(Par3Model $par3Model, Par4Model $par4Model, Par5Model $par5Model, PlayerTournamentRepository $playerTournamentRepository, EntityManagerInterface $entityManager, RoundRepository $roundRepository)
    {
        $this->par3Model = $par3Model;
        $this->par4Model = $par4Model;
        $this->par5Model = $par5Model;
        $this->playerTournamentRepository = $playerTournamentRepository;
        $this->entityManager = $entityManager;
        $this->roundRepository = $roundRepository;
    }

    /**
     * @param PlayerSimulationObject[] $playerArray
     * @param HoleSimResponseDto[] $courseArray
     * @param $numberOfRounds
     * @param Tournament $tournament
     * @param Hole[] $allHoles
     * @param Player[] $allPlayers
     * @return Tournament
     */
    public function playerIterator(iterable $playerArray, iterable $courseArray, $numberOfRounds, Tournament $tournament, iterable $allHoles, iterable $allPlayers): Tournament {
        for ($x = 0; $x < count($playerArray); $x++) {
            $playerTournamentReturn = $this->roundIterator($playerArray[$x], $courseArray, $numberOfRounds, $allHoles);
            $playerTournamentReturn->setPlayer($allPlayers[$x]);
            $tournament->addPlayerTournament($playerTournamentReturn);
        }
        return $tournament;
    }

    /**
     * @param PlayerSimulationObject $player
     * @param HoleSimResponseDto[] $courseArray
     * @param int $numberOfRounds
     * @param Hole[] $allHoles
     * @return PlayerTournament
     */
    public function roundIterator(PlayerSimulationObject $player, iterable $courseArray, int $numberOfRounds, iterable $allHoles):PlayerTournament {
        $playerTournament = new PlayerTournament();
        $tournamentTotal = 0;
        $luckTotal = 0;
        for ($x = 0; $x < $numberOfRounds; $x++) {
            $roundReturn = $this->holeIterator($player, $courseArray, $allHoles);
            $tournamentTotal += $roundReturn->getRoundTotal();
            $luckTotal += $roundReturn->getLuckScore();
            $playerTournament->addRoundId($roundReturn);
        }
        $playerTournament->setTotalScore($tournamentTotal);
        $playerTournament->setLuckScore($luckTotal/$numberOfRounds);
        $playerTournament->setTourPoints(0);
        return $playerTournament;
    }

    /**
     * @param PlayerSimulationObject $player
     * @param HoleSimResponseDto[] $courseArray
     * @param Hole[] $allHoles
     * @return Round
     */
    public function holeIterator(PlayerSimulationObject $player, iterable $courseArray, iterable $allHoles): Round
    {
        $round = new Round();
        $roundTotal = 0;
        $luckScore = 0;
        for ($x = 0; $x < count($courseArray); $x++) {
            $holeResult = $this->parSwitcher($player, $courseArray[$x]);
            $roundTotal += $holeResult->getScore();
            $luckScore += $holeResult->getLuck();
            $holePersist = $this->convertHoleResultDtoToHoleResults($holeResult, $round);
            $holePersist->setHole($allHoles[$x]);
            $round->addHoleResult($holePersist);
        }
        $round->setRoundTotal($roundTotal);
        $totalLuckScore = $luckScore / count($courseArray);
        $round->setLuckScore(round($totalLuckScore, 4, 1));
        return $round;
    }

    /**
     * @param PlayerSimulationObject $player
     * @param HoleSimResponseDto $hole
     * @return HoleResultDto
     */
    private function parSwitcher( PlayerSimulationObject $player, HoleSimResponseDto $hole):HoleResultDto {

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

    /**
     * @param PlayerSimulationObject[] $playerArray
     * @param HoleSimResponseDto[] $holeSimArray
     * @param $allHoles
     * @param Tournament $tournament
     * @return void
     */
    public function playoffIterator(iterable $playerArray, iterable $holeSimArray,
                                    $allHoles, Tournament $tournament): void
    {
        //simulate holes until there is no longer a tie
        for($h = 0; $h < count($holeSimArray); $h++) {
            for ($p = 0; $p < count($playerArray); $p++) {
                $holeResult = $this->parSwitcher($playerArray[$p], $holeSimArray[$h]);
                $player = $playerArray[$p];

                $thisPlayoffRound = $this->getPlayoffRound($tournament, $player);

                $holePersist = $this->convertHoleResultDtoToHoleResults($holeResult, $thisPlayoffRound);
                $thisPlayoffRound->addHoleResult($holePersist);

                $currentRoundTotal = $thisPlayoffRound->getRoundTotal();
                $thisPlayoffRound->setRoundTotal($currentRoundTotal + $holePersist->getScore());

                $average = $this->getAverageLuck($thisPlayoffRound);
                $thisPlayoffRound->setLuckScore($average);
                
                $this->entityManager->persist($thisPlayoffRound);
            }
            $playerTournamentWithPlayoffCollection = $tournament->getPlayerTournaments();

            $roundsToCompare = [];

            foreach ($playerTournamentWithPlayoffCollection as $pt) {
                $allRounds = $pt->getRound();
                $addRound = $allRounds->findFirst(function(int $key, Round $value):bool {
                    return $value->getRoundType() == 'playoff';
                });
                if ($addRound !== null) {
                    $roundsToCompare[] = $addRound;
                }
            }

            if ($roundsToCompare[0]->getRoundTotal() !== $roundsToCompare[1]->getRoundTotal()) {
                break;
            }
        }

        //playoff over
        //reassign place finishes

        $this->entityManager->flush();

        }

        private function getPlayoffRound(Tournament $tournament, PlayerSimulationObject $player): Round
        {
            $playerTournamentCollection = $tournament->getPlayerTournaments();
            $thisPlayerTournament = $playerTournamentCollection->findFirst(function(int $key, PlayerTournament $value) use ($player):bool {
                return $value->getPlayer()->getPlayerId() == $player->player_id;
            });

            $playoffRoundCollection = $thisPlayerTournament->getRound();
            return $playoffRoundCollection->findFirst(function(int $key, Round $value):bool {
                return $value->getRoundType() == 'playoff';
            });
        }

        private function getAverageLuck(Round $round): float{
            $allHoleResults = $round->getHoleResults();
            $sum = 0;
            foreach ($allHoleResults as $holeResult) {
                $sum += $holeResult->getLuck();
            }
            return $sum / count($allHoleResults);
        }


}
