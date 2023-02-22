<?php

namespace App\Dto\Response;

use App\Entity\Player;
use App\Entity\Role;

class SeasonLeaderboardDto
{
    public PlayerResponseDto $player;
    public int $season_total;

}