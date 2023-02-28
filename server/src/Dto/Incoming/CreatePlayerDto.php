<?php

namespace App\Dto\Incoming;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;


class CreatePlayerDto
{
    #[NotNull]
    #[Type('string')]
    public string $first_name;

    #[NotNull]
    #[Type('string')]
    public string $last_name;

    #[NotNull]
    #[Type('int')]
    public int $putt_skill;

    #[NotNull]
    #[Type('int')]
    public int $throw_power_skill;

    #[NotNull]
    #[Type('int')]
    public int $throw_accuracy_skill;

    #[NotNull]
    #[Type('int')]
    public int $scramble_skill;

    #[NotNull]
    #[Type('int')]
    public int $start_season;

    #[NotNull]
    #[Type('int')]
    public int $archetypeId;

    #[NotNull]
    #[Type('int')]
    public int $banked_skill_points;

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return int
     */
    public function getPuttSkill(): int
    {
        return $this->putt_skill;
    }

    /**
     * @param int $putt_skill
     */
    public function setPuttSkill(int $putt_skill): void
    {
        $this->putt_skill = $putt_skill;
    }

    /**
     * @return int
     */
    public function getThrowPowerSkill(): int
    {
        return $this->throw_power_skill;
    }

    /**
     * @param int $throw_power_skill
     */
    public function setThrowPowerSkill(int $throw_power_skill): void
    {
        $this->throw_power_skill = $throw_power_skill;
    }

    /**
     * @return int
     */
    public function getThrowAccuracySkill(): int
    {
        return $this->throw_accuracy_skill;
    }

    /**
     * @param int $throw_accuracy_skill
     */
    public function setThrowAccuracySkill(int $throw_accuracy_skill): void
    {
        $this->throw_accuracy_skill = $throw_accuracy_skill;
    }

    /**
     * @return int
     */
    public function getScrambleSkill(): int
    {
        return $this->scramble_skill;
    }

    /**
     * @param int $scramble_skill
     */
    public function setScrambleSkill(int $scramble_skill): void
    {
        $this->scramble_skill = $scramble_skill;
    }

    /**
     * @return int
     */
    public function getStartSeason(): int
    {
        return $this->start_season;
    }

    /**
     * @param int $start_season
     */
    public function setStartSeason(int $start_season): void
    {
        $this->start_season = $start_season;
    }

    /**
     * @return int
     */
    public function getArchetypeId(): int
    {
        return $this->archetypeId;
    }

    /**
     * @param int $archetypeId
     */
    public function setArchetypeId(int $archetypeId): void
    {
        $this->archetypeId = $archetypeId;
    }

    /**
     * @return int
     */
    public function getBankedSkillPoints(): int
    {
        return $this->banked_skill_points;
    }

    /**
     * @param int $banked_skill_points
     */
    public function setBankedSkillPoints(int $banked_skill_points): void
    {
        $this->banked_skill_points = $banked_skill_points;
    }


}
