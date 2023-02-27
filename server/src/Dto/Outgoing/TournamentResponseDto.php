<?php

namespace App\Dto\Outgoing;

class TournamentResponseDto
{
    public int $tournament_id;
    public string $tournament_name;
    public CourseResponseDto $courseResponseDto;
    public int $season;
    public iterable $player_tournament;

    /**
     * @param int $tournament_id
     * @param string $tournament_name
     * @param CourseResponseDto $courseResponseDto
     * @param int $season
     * @param iterable $player_tournament
     */
    public function __construct(int $tournament_id, string $tournament_name, CourseResponseDto $courseResponseDto, int $season, iterable $player_tournament)
    {
        $this->tournament_id = $tournament_id;
        $this->tournament_name = $tournament_name;
        $this->courseResponseDto = $courseResponseDto;
        $this->season = $season;
        $this->player_tournament = $player_tournament;
    }


}