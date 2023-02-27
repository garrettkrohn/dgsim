<?php

namespace App\Dto\Outgoing\Transformer;

use App\Dto\Outgoing\PlayerTournamentResponseDto;
use App\Dto\Outgoing\PlayerUpdateLogResponseDto;
use App\Dto\Outgoing\RoundResponseDto;
use App\Entity\PlayerTournament;
use App\Entity\PlayerUpdateLog;
use App\Entity\Round;

class PlayerUpdateLogResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    /**
     * @param PlayerUpdateLog $object
     * @return PlayerUpdateLogResponseDto
     */
    public function transformFromObject($object): PlayerUpdateLogResponseDto
    {
        $dto = new PlayerUpdateLogResponseDto();
        $dto->player_update_log_id = $object->getPlayerupdatelogId();
        $dto->update_time = $object->getUpdateTime();
        $dto->putt_increment = $object->getPuttIncrement();
        $dto->throw_power_increment = $object->getThrowPowerIncrement();
        $dto->throw_accuracy_increment = $object->getThrowAccuracyIncrement();
        $dto->scramble_increment = $object->getScrambleIncrement();
        $dto->previous_bank = $object->getPreviousBank();
        $dto->post_bank = $object->getPostBank();
        return $dto;
    }

}