<?php

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class TournamentResponseDto
{
    #[NotNull]
    #[Type('int')]
    public int $tournamentId;

    #[NotNull]
    #[Type('string')]
    public string $tournamentName;

    #[NotNull]
    public CourseResponseDto $courseResponseDto;

    #[NotNull]
    #[Type('int')]
    public int $season;

    #[NotNull]
    #[Type('iterable')]
    public iterable $playerTournaments;

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
     * @return CourseResponseDto
     */
    public function getCourseResponseDto(): CourseResponseDto
    {
        return $this->courseResponseDto;
    }

    /**
     * @param CourseResponseDto $courseResponseDto
     */
    public function setCourseResponseDto(CourseResponseDto $courseResponseDto): void
    {
        $this->courseResponseDto = $courseResponseDto;
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
     * @return iterable
     */
    public function getPlayerTournaments(): iterable
    {
        return $this->playerTournaments;
    }

    /**
     * @param iterable $playerTournaments
     */
    public function setPlayerTournaments(iterable $playerTournaments): void
    {
        $this->playerTournaments = $playerTournaments;
    }




}