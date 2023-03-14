<?php

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class SeasonStandingsDto extends StandingsDto
{
    #[NotNull]
    #[Type('int')]
    private int $seasonTotal;

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

}