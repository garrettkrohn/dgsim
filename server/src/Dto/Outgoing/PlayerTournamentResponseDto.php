<?php

namespace App\Dto\Outgoing;

class PlayerTournamentResponseDto
{
    public int $player_tournament_id;
    public PlayerDto $playerResponseDto;
    public iterable $rounds;
    public int $tour_points;
    public int $total_score;
}