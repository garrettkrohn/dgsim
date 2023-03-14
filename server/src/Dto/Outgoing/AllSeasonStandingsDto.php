<?php

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class AllSeasonStandingsDto
{

    #[NotNull]
    #[Type('int')]
    private int $season;

    #[NotNull]
    #[Type('iterable')]
    private iterable $standings;

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

    /**
     * @return iterable
     */
    public function getStandings(): iterable
    {
        return $this->standings;
    }

    /**
     * @param iterable $standings
     */
    public function setStandings(iterable $standings): void
    {
        $this->standings = $standings;
    }


}