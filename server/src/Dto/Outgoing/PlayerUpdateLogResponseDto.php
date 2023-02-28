<?php

namespace App\Dto\Outgoing;

use DateTime;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class PlayerUpdateLogResponseDto
{
    #[NotNull]
    #[Type('int')]
    public int $player_update_log_id;

    #[NotNull]
    public DateTime $update_time;

    #[NotNull]
    #[Type('int')]
    public int $player_id;

    #[NotNull]
    #[Type('int')]
    public int $putt_increment;

    #[NotNull]
    #[Type('int')]
    public int $throw_power_increment;

    #[NotNull]
    #[Type('int')]
    public int $throw_accuracy_increment;

    #[NotNull]
    #[Type('int')]
    public int $scramble_increment;

    #[NotNull]
    #[Type('int')]
    public int $previous_bank;

    #[NotNull]
    #[Type('int')]
    public int $post_bank;
}