<?php

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class TournamentTitlesDto
{

    #[NotNull]
    #[Type('int')]
    public int $tournamentId;

    #[NotNull]
    #[Type('string')]
    public string $tournamentName;

    #[NotNull]
    #[Type('int')]
    public int $season;

    /**
     * @return int
     */
    public function getTournamentId(): int
    {
        return $this->tournamentId;
    }

    /**
     * @param int $tournamentId
     */
    public function setTournamentId(int $tournamentId): void
    {
        $this->tournamentId = $tournamentId;
    }

    /**
     * @return string
     */
    public function getTournamentName(): string
    {
        return $this->tournamentName;
    }

    /**
     * @param string $tournamentName
     */
    public function setTournamentName(string $tournamentName): void
    {
        $this->tournamentName = $tournamentName;
    }

    /**
     * @return int
     */
    public function getSeason(): int
    {
        return $this->season;
    }

    /**
     * @param int $season
     */
    public function setSeason(int $season): void
    {
        $this->season = $season;
    }


}