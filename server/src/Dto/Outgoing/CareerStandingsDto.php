<?php

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class CareerStandingsDto extends StandingsDto
{
    #[NotNull]
    #[Type('int')]
    private int $careerTotal;

    /**
     * @return int
     */
    public function getCareerTotal(): int
    {
        return $this->careerTotal;
    }

    /**
     * @param int $careerTotal
     */
    public function setCareerTotal(int $careerTotal): void
    {
        $this->careerTotal = $careerTotal;
    }

}