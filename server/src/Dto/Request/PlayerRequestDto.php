<?php

namespace App\Dto\Request;

class PlayerRequestDto
{
    public string $first_name;
    public string $last_name;
    public int $putt_skill;
    public int $throw_power_skill;
    public int $throw_accuracy_skill;
    public int $scramble_skill;
    public int $start_season;
    public string $archetypeName;
}
//{"firstName": "Garrett",
//"lastName": "Gurthie",
//"puttSkill": "100",
//"throwPowerSkill": "100",
//"throwAccuracySkill": "100",
//"scrambleSkill": "100",
//"startSeason": "1",
//"bankedSkillPoints": "0",
//"archetypeName": "putter"}