<?php

namespace App\Service;

use App\Dto\Outgoing\AllSeasonStandingsDto;
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
    private PlayerService $playerService;
    private PlayerTournamentService $playerTournamentService;
    private TournamentService $tournamentService;

    /**
     * @param PlayerRepository $playerRepository
     * @param PlayerService $playerService
     * @param PlayerTournamentService $playerTournamentService
     * @param TournamentService $tournamentService
     */
    public function __construct(PlayerRepository $playerRepository, PlayerService $playerService, PlayerTournamentService $playerTournamentService, TournamentService $tournamentService)
    {
        $this->playerRepository = $playerRepository;
        $this->playerService = $playerService;
        $this->playerTournamentService = $playerTournamentService;
        $this->tournamentService = $tournamentService;
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

    /**
     * @param SeasonStandingsDto $a
     * @param SeasonStandingsDto $b
     * @return int
     */
    private function cmp(SeasonStandingsDto $a, SeasonStandingsDto $b): int
    {
        return ($b->getSeasonTotal() - $a->getSeasonTotal());
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

        //sort
        usort($allSeasonLeaderboards, [$this, "cmp"]);

        return $allSeasonLeaderboards;
    }

    public function getAllSeasonLeaderboards(): iterable
    {
        $seasons = $this->tournamentService->getAvailableSeasons();

        $returnArray = [];

        foreach($seasons as $season) {
            $dto = new AllSeasonStandingsDto();
            $dto->setSeason($season);
            $dto->setStandings($this->getSeasonLeaderboard($season));
            $returnArray[] = $dto;
        }
        return $returnArray;
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
}