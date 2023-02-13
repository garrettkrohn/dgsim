<?php

namespace App\Service\Simulation;

class PlayerIngester
{
    public function convertPlayer($player, $FLOOR_CEILING): PlayerSimulationObject {

        $c1x_putt = $this->convertPlayerSkillToOdds($FLOOR_CEILING->c1xFloorCeiling[0], $FLOOR_CEILING->c1xFloorCeiling[1],$player->putt_skill);
        $c2_putt = $this->convertPlayerSkillToOdds($FLOOR_CEILING->c2FloorCeiling[0], $FLOOR_CEILING->c2FloorCeiling[1], $player->putt_skill);
        $acc_parked = $this->convertPlayerSkillToOdds($FLOOR_CEILING->parkedFloorCeiling[0], $FLOOR_CEILING->parkedFloorCeiling[1], $player->throw_accuracy_skill);
        $acc_c1 = $this->convertPlayerSkillToOdds($FLOOR_CEILING->c1RegFloorCeiling[0],$FLOOR_CEILING->c1RegFloorCeiling[1], $player->throw_accuracy_skill);
        $acc_c2 = $this->convertPlayerSkillToOdds($FLOOR_CEILING->c2RegFloorCeiling[0], $FLOOR_CEILING->c2RegFloorCeiling[1], $player->throw_accuracy_skill);
        $pwr_parked = $this->convertPlayerSkillToOdds($FLOOR_CEILING->parkedFloorCeiling[0], $FLOOR_CEILING->parkedFloorCeiling[1], $player->throw_power_skill);
        $pwr_c1 = $this->convertPlayerSkillToOdds($FLOOR_CEILING->c1RegFloorCeiling[0],$FLOOR_CEILING->c1RegFloorCeiling[1], $player->throw_power_skill);
        $pwr_c2 = $this->convertPlayerSkillToOdds($FLOOR_CEILING->c2RegFloorCeiling[0], $FLOOR_CEILING->c2RegFloorCeiling[1], $player->throw_power_skill);
        $scramble = $this->convertPlayerSkillToOdds($FLOOR_CEILING->scrambleFloorCeiling[0], $FLOOR_CEILING->scrambleFloorCeiling[1], $player->scramble_skill);

        return new PlayerSimulationObject($player->player_id, $c1x_putt, $c2_putt, $acc_parked, ($acc_c1 - $acc_parked), ($acc_c2 - $acc_c1 - $acc_parked), $pwr_parked, ($pwr_c1 - $pwr_parked), ($pwr_c2 - $pwr_c1 - $pwr_parked), $scramble);
    }

    //takes in the skill floor, skill ceiling, 0-100 skill and spits out the odds
    private function convertPlayerSkillToOdds($skillFloor, $skillCeiling, $skill):float {
        $increment = (($skillCeiling - $skillFloor) /100);
        return ($skillFloor + ($skill * $increment));
    }
}