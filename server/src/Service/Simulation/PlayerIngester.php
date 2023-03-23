<?php

namespace App\Service\Simulation;

use App\Dto\Outgoing\PlayerDto;

class PlayerIngester
{

    /**
     * @param PlayerDto $player
     * @param $FLOOR_CEILING
     * @return PlayerSimulationObject
     */
    public function convertPlayer(PlayerDto $player, $FLOOR_CEILING): PlayerSimulationObject {

        $c1x_putt = $this->convertPlayerSkillToOdds($FLOOR_CEILING->c1xFloorCeiling[0], $FLOOR_CEILING->c1xFloorCeiling[1],$player->puttSkill);
        $c2_putt = $this->convertPlayerSkillToOdds($FLOOR_CEILING->c2FloorCeiling[0], $FLOOR_CEILING->c2FloorCeiling[1], $player->puttSkill);
        $acc_parked = $this->convertPlayerSkillToOdds($FLOOR_CEILING->parkedFloorCeiling[0], $FLOOR_CEILING->parkedFloorCeiling[1], $player->throwAccuracySkill);
        $acc_c1 = $this->convertPlayerSkillToOdds($FLOOR_CEILING->c1RegFloorCeiling[0],$FLOOR_CEILING->c1RegFloorCeiling[1], $player->throwAccuracySkill);
        $acc_c2 = $this->convertPlayerSkillToOdds($FLOOR_CEILING->c2RegFloorCeiling[0], $FLOOR_CEILING->c2RegFloorCeiling[1], $player->throwAccuracySkill);
        $pwr_parked = $this->convertPlayerSkillToOdds($FLOOR_CEILING->parkedFloorCeiling[0], $FLOOR_CEILING->parkedFloorCeiling[1], $player->throwPowerSkill);
        $pwr_c1 = $this->convertPlayerSkillToOdds($FLOOR_CEILING->c1RegFloorCeiling[0],$FLOOR_CEILING->c1RegFloorCeiling[1], $player->throwPowerSkill);
        $pwr_c2 = $this->convertPlayerSkillToOdds($FLOOR_CEILING->c2RegFloorCeiling[0], $FLOOR_CEILING->c2RegFloorCeiling[1], $player->throwPowerSkill);
        $scramble = $this->convertPlayerSkillToOdds($FLOOR_CEILING->scrambleFloorCeiling[0], $FLOOR_CEILING->scrambleFloorCeiling[1], $player->scrambleSkill);

        return new PlayerSimulationObject($player->playerId, $c1x_putt, $c2_putt, $acc_parked, ($acc_c1 - $acc_parked), ($acc_c2 - $acc_c1 - $acc_parked), $pwr_parked, ($pwr_c1 - $pwr_parked), ($pwr_c2 - $pwr_c1 - $pwr_parked), $scramble);
    }

    //takes in the skill floor, skill ceiling, 0-100 skill and spits out the odds
    public function convertPlayerSkillToOdds($skillFloor, $skillCeiling, $skill):float {
        $increment = (($skillCeiling - $skillFloor) /100);
        $result = ($skillFloor + ($skill * $increment));
        return round($result, 4, 1);
    }
}