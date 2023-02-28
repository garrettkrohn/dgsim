<?php

namespace App\Dto\Incoming;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class UpdatePlayerDto extends CreatePlayerDto
{
    #[NotNull]
    #[Type('int')]
    public int $player_id;

    /**
     * @return int
     */
    public function getPlayerId(): int
    {
        return $this->player_id;
    }

    /**
     * @param int $player_id
     */
    public function setPlayerId(int $player_id): void
    {
        $this->player_id = $player_id;
    }



}