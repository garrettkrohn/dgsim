<?php

namespace App\Dto\Incoming;

class CreateTournamentDto
{
    private string $tournamentName;
    private int $courseId;
    private int $season;
    private int $numberOfRounds;

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
    public function getCourseId(): int
    {
        return $this->courseId;
    }

    /**
     * @param int $courseId
     */
    public function setCourseId(int $courseId): void
    {
        $this->courseId = $courseId;
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

    /**
     * @return int
     */
    public function getNumberOfRounds(): int
    {
        return $this->numberOfRounds;
    }

    /**
     * @param int $numberOfRounds
     */
    public function setNumberOfRounds(int $numberOfRounds): void
    {
        $this->numberOfRounds = $numberOfRounds;
    }


}