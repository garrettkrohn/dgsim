<?php

namespace App\Dto\Outgoing;

use App\Entity\Role;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class leaderboardDto
{
    #[NotNull]
    #[Type('int')]
    public int $score;

    #[NotNull]
    #[Type('int')]
    public int $playerTournamentId;

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


}