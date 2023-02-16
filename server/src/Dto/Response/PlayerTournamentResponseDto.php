<?php

namespace App\Dto\Response;

class PlayerTournamentResponseDto
{
    public int $player_tournament_id;
    public PlayerResponseDto $playerResponseDto;
    public iterable $rounds;
    public int $tour_points;
    public int $total_score;
}