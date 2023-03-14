<?php

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class SeasonStandingsDto extends StandingsDto
{
    #[NotNull]
    #[Type('int')]
    private int $seasonTotal;

    #[NotNull]
    #[Type('int')]
    private int $season;

    /**
     * @return int
     */
    public function getSeasonTotal(): int
    {
        return $this->seasonTotal;
    }

    /**
     * @param int $seasonTotal
     */
    public function setSeasonTotal(int $seasonTotal): void
    {
        $this->seasonTotal = $seasonTotal;
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