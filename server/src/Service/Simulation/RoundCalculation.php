<?php

namespace App\Service\Simulation;

class RoundCalculation {
    private int $holesPlayed;
    private int $roundTotal;
    private iterable $rounds;
    private int $playerTournamentId;
    private int $finalPlace;

    /**
     * @return int
     */
    public function getFinalPlace(): int
    {
        return $this->finalPlace;
    }

    /**
     * @param int $finalPlace
     */
    public function setFinalPlace(int $finalPlace): void
    {
        $this->finalPlace = $finalPlace;
    }

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
     * @return int
     */
    public function getHolesPlayed(): int
    {
        return $this->holesPlayed;
    }

    /**
     * @param int $holesPlayed
     */
    public function setHolesPlayed(int $holesPlayed): void
    {
        $this->holesPlayed = $holesPlayed;
    }

    /**
     * @return int
     */
    public function getRoundTotal(): int
    {
        return $this->roundTotal;
    }

    /**
     * @param int $roundTotal
     */
    public function setRoundTotal(int $roundTotal): void
    {
        $this->roundTotal = $roundTotal;
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

}