<?php

namespace App\Dto\Outgoing;

use App\Entity\Player;
use App\Entity\Role;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class SeasonLeaderboardDto
{
    #[NotNull]
    #[Type('int')]
    public int $player_id;

    #[NotNull]
    #[Type('string')]
    public string $player_name;

    #[NotNull]
    #[Type('int')]
    public int $season_total;

}