<?php

namespace App\Service;

use App\Dto\Outgoing\CareerStandingsDto;
use App\Dto\Outgoing\StandingsDto;
use App\Dto\Outgoing\Transformer\PlayerResponseDtoTransformer;
use App\Entity\PlayerTournament;
use App\Repository\PlayerRepository;
use App\Repository\PlayerTournamentRepository;

class SeasonLeaderboardService
{
    private PlayerRepository $playerRepository;
    private PlayerTournamentRepository $playerTournamentRepository;
    private PlayerService $playerService;

    /**
     * @param PlayerRepository $playerRepository
     * @param PlayerTournamentRepository $playerTournamentRepository
     * @param PlayerService $playerService
     */
    public function __construct(PlayerRepository $playerRepository, PlayerTournamentRepository $playerTournamentRepository, PlayerService $playerService)
    {
        $this->playerRepository = $playerRepository;
        $this->playerTournamentRepository = $playerTournamentRepository;
        $this->playerService = $playerService;
    }

    public function getCareerLeaderboard(): iterable
    {
        $allPlayers = $this->playerRepository->findAll();

        $allCareerLeaderboards = [];
        foreach($allPlayers as $player) {
            $tournamentsByPlayer = $this->playerTournamentRepository->findBy(['player' => $player]);
            $careerTotalPoints = $this->calculateSeasonTotal($tournamentsByPlayer);
            $careerStandingsDto = new CareerStandingsDto();
            $careerStandingsDto->setPlayer($this->playerService->transformFromObject($player));
            $careerStandingsDto->setCareerTotal($careerTotalPoints);
            $allCareerLeaderboards[] = $careerStandingsDto;
        }
        return $allCareerLeaderboards;
    }

    /**
     * @param PlayerTournament[] $playerTournaments
     * @return int
     */
    public function calculateSeasonTotal(iterable $playerTournaments): int
    {
        $seasonTotalPoints = 0;
        foreach ($playerTournaments as $playerTournament) {
            $seasonTotalPoints += $playerTournament->getTourPoints();
        }
        return $seasonTotalPoints;
    }

    public function getAllSeasonLeaderboards(): iterable
    {

    }

}