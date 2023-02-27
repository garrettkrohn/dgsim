<?php

namespace App\Dto\Outgoing;

use App\Entity\Role;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class leaderboardDto
{
    #[NotNull]
    #[Type('int')]
    public int $score;

    #[NotNull]
    #[Type('int')]
    public int $playerTournamentId;
}