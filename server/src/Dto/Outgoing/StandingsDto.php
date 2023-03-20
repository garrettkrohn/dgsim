<?php

namespace App\Dto\Outgoing;

use App\Entity\Player;
use App\Entity\Role;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class StandingsDto
{
    #[NotNull]
    private PlayerDto $player;

    private int $rank;

    /**
     * @return int
     */
    public function getRank(): int
    {
        return $this->rank;
    }

    /**
     * @param int $rank
     */
    public function setRank(int $rank): void
    {
        $this->rank = $rank;
    }

    /**
     * @return PlayerDto
     */
    public function getPlayer(): PlayerDto
    {
        return $this->player;
    }

    /**
     * @param PlayerDto $player
     */
    public function setPlayer(PlayerDto $player): void
    {
        $this->player = $player;
    }



}