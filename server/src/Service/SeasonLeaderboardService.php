<?php

namespace App\Service;

use App\Dto\Outgoing\SeasonLeaderboardDto;
use App\Dto\Outgoing\Transformer\PlayerResponseDtoTransformer;
use App\Entity\PlayerTournament;
use App\Repository\PlayerRepository;
use App\Repository\PlayerTournamentRepository;

class SeasonLeaderboardService
{
    private PlayerRepository $playerRepository;
    private PlayerTournamentRepository $playerTournamentRepository;

    public function __construct(PlayerRepository $playerRepository, PlayerTournamentRepository $playerTournamentRepository)
    {
        $this->playerRepository = $playerRepository;
        $this->playerTournamentRepository = $playerTournamentRepository;
    }

    public function getSeasonLeaderboard(int $seasonId): iterable
    {
        $allPlayers = $this->playerRepository->findAll();
        $allPlayerTournaments = $this->playerTournamentRepository->findAll();

        $allLeaderboardPlayers = [];
        foreach($allPlayers as $player) {
            $tournamentsByPlayer = $this->playerTournamentRepository->findBy(['player' => $player]);
            $totalSeasonPoints = $this->calculateSeasonTotal($tournamentsByPlayer);
            $leaderboardDto = new SeasonLeaderboardDto();
            $leaderboardDto->player_id = $player->getPlayerId();
            $leaderboardDto->player_name = $player->getFirstName() . " " . $player->getLastName();
            $leaderboardDto->season_total = $totalSeasonPoints;
            $allLeaderboardPlayers[] = $leaderboardDto;
        }
        return $allLeaderboardPlayers;
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

}