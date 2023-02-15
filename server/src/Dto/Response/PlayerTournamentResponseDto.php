<?php

namespace App\Dto\Response;

class PlayerTournamentResponseDto
{
    public int $player_tournament_id;
    public PlayerResponseDto $playerResponseDto;
    public RoundResponseDto $roundResponseDto;
    public int $tour_points;
    public int $total_score;

    public function __construct(int $player_tournament_id, PlayerResponseDto $playerResponseDto, RoundResponseDto $roundResponseDto, int $tour_points, int $total_score)
    {
        $this->player_tournament_id = $player_tournament_id;
        $this->playerResponseDto = $playerResponseDto;
        $this->roundResponseDto = $roundResponseDto;
        $this->tour_points = $tour_points;
        $this->total_score = $total_score;
    }


}