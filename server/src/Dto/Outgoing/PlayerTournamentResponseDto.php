<?php

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class PlayerTournamentResponseDto
{
    #[NotNull]
    #[Type('int')]
    public int $player_tournament_id;

    #[NotNull]
    public PlayerDto $playerResponseDto;

    #[NotNull]
    #[Type('iterable')]
    public iterable $rounds;

    #[NotNull]
    #[Type('int')]
    public int $tour_points;

    #[NotNull]
    #[Type('int')]
    public int $total_score;


    /**
     * @return int
     */
    public function getPlayerTournamentId(): int
    {
        return $this->player_tournament_id;
    }

    /**
     * @param int $player_tournament_id
     */
    public function setPlayerTournamentId(int $player_tournament_id): void
    {
        $this->player_tournament_id = $player_tournament_id;
    }

    /**
     * @return PlayerDto
     */
    public function getPlayerResponseDto(): PlayerDto
    {
        return $this->playerResponseDto;
    }

    /**
     * @param PlayerDto $playerResponseDto
     */
    public function setPlayerResponseDto(PlayerDto $playerResponseDto): void
    {
        $this->playerResponseDto = $playerResponseDto;
    }

    /**
     * @return iterable
     */
    public function getRounds(): iterable
    {
        return $this->rounds;
    }

    /**
     * @param iterable $rounds
     */
    public function setRounds(iterable $rounds): void
    {
        $this->rounds = $rounds;
    }

    /**
     * @return int
     */
    public function getTourPoints(): int
    {
        return $this->tour_points;
    }

    /**
     * @param int $tour_points
     */
    public function setTourPoints(int $tour_points): void
    {
        $this->tour_points = $tour_points;
    }

    /**
     * @return int
     */
    public function getTotalScore(): int
    {
        return $this->total_score;
    }

    /**
     * @param int $total_score
     */
    public function setTotalScore(int $total_score): void
    {
        $this->total_score = $total_score;
    }


}