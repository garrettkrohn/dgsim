<?php

namespace App\Dto\Outgoing;

use DateTime;

class PlayerUpdateLogResponseDto
{
    public int $player_update_log_id;
    public DateTime $update_time;
    public int $player_id;
    public int $putt_increment;
    public int $throw_power_increment;
    public int $throw_accuracy_increment;
    public int $scramble_increment;
    public int $previous_bank;
    public int $post_bank;
}