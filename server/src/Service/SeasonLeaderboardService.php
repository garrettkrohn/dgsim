<?php

namespace App\Service;

use App\Dto\Outgoing\CareerStandingsDto;
use App\Dto\Outgoing\SeasonStandingsDto;
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
    private PlayerTournamentService $playerTournamentService;

    /**
     * @param PlayerRepository $playerRepository
     * @param PlayerTournamentRepository $playerTournamentRepository
     * @param PlayerService $playerService
     * @param PlayerTournamentService $playerTournamentService
     */
    public function __construct(PlayerRepository $playerRepository, PlayerTournamentRepository $playerTournamentRepository, PlayerService $playerService, PlayerTournamentService $playerTournamentService)
    {
        $this->playerRepository = $playerRepository;
        $this->playerTournamentRepository = $playerTournamentRepository;
        $this->playerService = $playerService;
        $this->playerTournamentService = $playerTournamentService;
    }


    public function getCareerLeaderboard(): iterable
    {
        $allPlayers = $this->playerRepository->findAll();

        $allCareerLeaderboards = [];
        foreach($allPlayers as $player) {
            $tournamentsByPlayer = $this->playerTournamentService->getPlayerTournamentsByPlayer($player);
            $careerTotalPoints = $this->calculateLeaderboardTotal($tournamentsByPlayer);
            $careerStandingsDto = new CareerStandingsDto();
            $careerStandingsDto->setPlayer($this->playerService->transformFromObject($player));
            $careerStandingsDto->setCareerTotal($careerTotalPoints);
            $allCareerLeaderboards[] = $careerStandingsDto;
        }
        return $allCareerLeaderboards;
    }

    public function getSeasonLeaderboard(int $seasonNumber): iterable
    {
        $allPlayers = $this->playerRepository->findAll();

        $allSeasonLeaderboards = [];
        foreach($allPlayers as $player) {
            $tournamentsByPlayer = $this->playerTournamentService->getPlayerTournamentsByPlayerIdAndSeason($player, $seasonNumber);
            $seasonTotalPoints = $this->calculateLeaderboardTotal($tournamentsByPlayer);
            $dto = new SeasonStandingsDto();
            $dto->setPlayer($this->playerService->transformFromObject($player));
            $dto->setSeasonTotal($seasonTotalPoints);

            $allSeasonLeaderboards[] = $dto;
        }
        return $allSeasonLeaderboards;
    }

    /**
     * @param PlayerTournament[] $playerTournaments
     * @return int
     */
    public function calculateLeaderboardTotal(iterable $playerTournaments): int
    {
        $seasonTotalPoints = 0;
        foreach ($playerTournaments as $playerTournament) {
            $seasonTotalPoints += $playerTournament->getTourPoints();
        }
        return $seasonTotalPoints;
    }

//    public function getAllSeasonLeaderboards(): iterable
//    {
//
//    }

}