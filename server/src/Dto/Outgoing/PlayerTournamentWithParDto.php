<?php

namespace App\Dto\Outgoing;

class PlayerTournamentWithParDto extends PlayerTournamentResponseDto
{
    private int $coursePar;

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