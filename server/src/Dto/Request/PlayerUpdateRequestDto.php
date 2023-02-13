<?php

namespace App\Dto\Request;

class PlayerUpdateRequestDto extends PlayerRequestDto
{
    public int $player_id;
}

//adding in the player_id for updates