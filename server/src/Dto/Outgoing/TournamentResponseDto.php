<?php

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class TournamentResponseDto
{
    #[NotNull]
    #[Type('int')]
    public int $tournament_id;

    #[NotNull]
    #[Type('string')]
    public string $tournament_name;

    #[NotNull]
    public CourseResponseDto $courseResponseDto;

    #[NotNull]
    #[Type('int')]
    public int $season;

    #[NotNull]
    #[Type('iterable')]
    public iterable $player_tournament;

    /**
     * @return int
     */
    public function getTournamentId(): int
    {
        return $this->tournament_id;
    }

    /**
     * @param int $tournament_id
     */
    public function setTournamentId(int $tournament_id): void
    {
        $this->tournament_id = $tournament_id;
    }

    /**
     * @return string
     */
    public function getTournamentName(): string
    {
        return $this->tournament_name;
    }

    /**
     * @param string $tournament_name
     */
    public function setTournamentName(string $tournament_name): void
    {
        $this->tournament_name = $tournament_name;
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
    public function getPlayerTournament(): iterable
    {
        return $this->player_tournament;
    }

    /**
     * @param iterable $player_tournament
     */
    public function setPlayerTournament(iterable $player_tournament): void
    {
        $this->player_tournament = $player_tournament;
    }




}