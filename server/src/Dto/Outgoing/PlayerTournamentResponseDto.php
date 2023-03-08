<?php

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class PlayerTournamentResponseDto
{
    #[NotNull]
    #[Type('int')]
    public int $playerTournamentId;

    #[NotNull]
    public PlayerDto $playerResponseDto;

    #[NotNull]
    #[Type('iterable')]
    public iterable $rounds;

    #[NotNull]
    #[Type('int')]
    public int $tourPoints;

    #[NotNull]
    #[Type('int')]
    public int $totalScore;

    #[NotNull]
    #[Type('float')]
    public int $luckScore;

    #[NotNull]
    #[Type('int')]
    public int $place;

    #[NotNull]
    #[Type('int')]
    public int $coursePar;

    /**
     * @return int
     */
    public function getPlayerTournamentId(): int
    {
        return $this->playerTournamentId;
    }

    /**
     * @param int $playerTournamentId
     */
    public function setPlayerTournamentId(int $playerTournamentId): void
    {
        $this->playerTournamentId = $playerTournamentId;
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
        return $this->tourPoints;
    }

    /**
     * @param int $tourPoints
     */
    public function setTourPoints(int $tourPoints): void
    {
        $this->tourPoints = $tourPoints;
    }

    /**
     * @return int
     */
    public function getTotalScore(): int
    {
        return $this->totalScore;
    }

    /**
     * @param int $totalScore
     */
    public function setTotalScore(int $totalScore): void
    {
        $this->totalScore = $totalScore;
    }

    /**
     * @return int
     */
    public function getLuckScore(): int
    {
        return $this->luckScore;
    }

    /**
     * @param int $luckScore
     */
    public function setLuckScore(int $luckScore): void
    {
        $this->luckScore = $luckScore;
    }

    /**
     * @return int
     */
    public function getPlace(): int
    {
        return $this->place;
    }

    /**
     * @param int $place
     */
    public function setPlace(int $place): void
    {
        $this->place = $place;
    }

    /**
     * @return int
     */
    public function getCoursePar(): int
    {
        return $this->coursePar;
    }

    /**
     * @param int $coursePar
     */
    public function setCoursePar(int $coursePar): void
    {
        $this->coursePar = $coursePar;
    }



}