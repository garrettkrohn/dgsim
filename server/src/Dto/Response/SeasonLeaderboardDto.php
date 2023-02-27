<?php

namespace App\Dto\Response;

use App\Entity\Player;
use App\Entity\Role;

class SeasonLeaderboardDto
{
    public int $player_id;
    public string $player_name;
    public int $season_total;

}