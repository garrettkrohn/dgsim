<?php

namespace App\Dto\Incoming;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class CreateTournamentDto
{
    #[NotNull]
    #[Type('string')]
    private string $tournamentName;

    #[NotNull]
    #[Type('int')]
    private int $courseId;

    #[NotNull]
    #[Type('int')]
    private int $season;

    #[NotNull]
    #[Type('int')]
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