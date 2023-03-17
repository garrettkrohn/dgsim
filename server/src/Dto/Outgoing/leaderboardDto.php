<?php

namespace App\Dto\Outgoing;

use App\Entity\PlayerTournament;
use App\Entity\Role;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class leaderboardDto
{
    #[NotNull]
    #[Type('int')]
    public int $score;

    #[NotNull]
    #[Type('PlayerTournament')]
    public PlayerTournament $playerTournament;

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @param int $score
     */
    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    /**
     * @return PlayerTournament
     */
    public function getPlayerTournament(): PlayerTournament
    {
        return $this->playerTournament;
    }

    /**
     * @param PlayerTournament $playerTournament
     */
    public function setPlayerTournament(PlayerTournament $playerTournament): void
    {
        $this->playerTournament = $playerTournament;
    }



}