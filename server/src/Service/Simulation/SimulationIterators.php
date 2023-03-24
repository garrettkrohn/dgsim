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
use App\Repository\PlayerRepository;
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
    private PlayerRepository $playerRepository;

    /**
     * @param Par3Model $par3Model
     * @param Par4Model $par4Model
     * @param Par5Model $par5Model
     * @param PlayerTournamentRepository $playerTournamentRepository
     * @param EntityManagerInterface $entityManager
     * @param RoundRepository $roundRepository
     * @param PlayerRepository $playerRepository
     */
    public function __construct(Par3Model $par3Model, Par4Model $par4Model, Par5Model $par5Model, PlayerTournamentRepository $playerTournamentRepository, EntityManagerInterface $entityManager, RoundRepository $roundRepository, PlayerRepository $playerRepository)
    {
        $this->par3Model = $par3Model;
        $this->par4Model = $par4Model;
        $this->par5Model = $par5Model;
        $this->playerTournamentRepository = $playerTournamentRepository;
        $this->entityManager = $entityManager;
        $this->roundRepository = $roundRepository;
        $this->playerRepository = $playerRepository;
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
        $holeResult->setC1Putts($hole->c1Putts);
        $holeResult->setC2Putts($hole->c2Putts);
        $holeResult->setParked($hole->parked);
        $holeResult->setC1InRegulation($hole->c1InRegulation);
        $holeResult->setC2InRegulation($hole->c2InRegulation);
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
        /**@var PlayerSimulationObject[] $tiedPlayerArray */
        $tiedPlayerArray = [];
        foreach($playerArray as $player) {
            $tiedPlayerArray[] = $player;
        }
        $tied = true;
        $holeIndex = -1;

        while ($tied) {
            if ($holeIndex === 17) {
                $holeIndex = 0;
            } else {
                $holeIndex++;
            }

            /** @var RoundCalculation[] $dto */
            $holeResults = $this->playoffPlayerIterator($tiedPlayerArray, $holeSimArray[$holeIndex], $tournament, $allHoles[$holeIndex]);

//            $roundsToCompare = $this->getPlayoffRounds($tournament);

            //sort the rounds descending
            usort($holeResults, function ($a, $b) {
                if ($a->getScore() == $b->getScore()) {
                    return 0;
                }
                return ($a < $b) ? -1 : 1;
            });

            $topScore = $holeResults[0]->getScore();

            unset($tiedPlayerArray);

            $tiedPlayerArray = $this->checkForTiedPlayers($holeResults, $playerArray, $topScore, $tournament);

            if (count($tiedPlayerArray) === 1) {
                $tied = false;
                $this->persistPlayerPlace(1, $tiedPlayerArray[0]->getPlayerId(), $tournament);
            }
        }

        $this->entityManager->flush();

        }

        private function getPlayoffRounds($tournament): array
        {
            $allPlayerTournaments = $tournament->getPlayerTournaments();

            /** @var Round[] $roundsToCompare */
            $roundsToCompare = [];

            //get all tournament rounds
            foreach ($allPlayerTournaments as $pt) {
                $allRounds = $pt->getRound();
                $addRound = $allRounds->findFirst(function (int $key, Round $value): bool {
                    return $value->getRoundType() == 'playoff';
                });
                if ($addRound !== null) {
                    $roundsToCompare[] = $addRound;
                }
            }
            return $roundsToCompare;
        }

    /**
     * @param RoundCalculation[] $rounds
     * @param PlayerSimulationObject[] $playerArray
     * @param int $topScore
     * @param Tournament $tournament
     * @return array
     */
        private function checkForTiedPlayers( iterable $rounds, iterable $playerArray, int $topScore, Tournament $tournament): array
        {
            $returnArray = [];
            foreach($rounds as $round) {
                if ($round->getScore() == $topScore) {
                    $playerId = $round->getPlayerSimulationObject()->getPlayerId();
                    $returnArray[] = $this->findPlayerSimObjectByPlayerId($playerArray, $playerId);
                } else {
                    //persist 2nd place for that player
                    $this->persistPlayerPlace(2, $round->getPlayerSimulationObject()->getPlayerId(), $tournament);

                }
            }
            return $returnArray;
        }

        private function persistPlayerPlace(int $place, int $playerId, Tournament $tournament): void
        {
            $playerObject = $this->playerRepository->find($playerId);
            $playerTournament = $this->playerTournamentRepository->findOneBy(['tournament' => $tournament, 'player' => $playerObject]);
            $playerTournament->setPlace($place);
            $this->entityManager->persist($playerTournament);
        }

    /**
     * @param PlayerSimulationObject[] $array
     * @param int $id
     * @return PlayerSimulationObject | null
     */
        private function findPlayerSimObjectByPlayerId(iterable $array, int $id): PlayerSimulationObject | null
        {
            foreach ($array as $element) {
                if ($id === $element->getPlayerId()) {
                    return $element;
                }
            }
            return null;
        }

    /**
     * @param PlayerSimulationObject[] $playerArray
     * @param HoleSimResponseDto $hole
     * @param Tournament $tournament
     * @param Hole $holeObject
     * @return RoundCalculation[]
     */
        private function playoffPlayerIterator(iterable $playerArray, HoleSimResponseDto$hole, Tournament $tournament, Hole $holeObject): array
        {
            $returnArray = [];
            //iterate through players
            for ($p = 0; $p < count($playerArray); $p++) {
                $holeResult = $this->parSwitcher($playerArray[$p], $hole);
                $player = $playerArray[$p];

                $dto = new RoundCalculation();
                $dto->setPlayerSimulationObject($player);
                $dto->setScore($holeResult->getScore());
                $returnArray[] = $dto;

                $thisPlayoffRound = $this->getPlayoffRound($tournament, $player);

                $holePersist = $this->convertHoleResultDtoToHoleResults($holeResult, $thisPlayoffRound);
                $holePersist->setHole($holeObject);
                $thisPlayoffRound->addHoleResult($holePersist);

                $currentRoundTotal = $thisPlayoffRound->getRoundTotal();
                $thisPlayoffRound->setRoundTotal($currentRoundTotal + $holePersist->getScore());

                $average = $this->getAverageLuck($thisPlayoffRound);
                $thisPlayoffRound->setLuckScore($average);

                $this->entityManager->persist($thisPlayoffRound);
            }
            return $returnArray;
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



