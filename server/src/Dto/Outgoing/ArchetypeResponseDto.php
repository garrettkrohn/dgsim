<?php

declare(strict_types=1);

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class ArchetypeResponseDto
{
    #[NotNull]
    #[Type('int')]
    public int $archetype_id;

    #[NotNull]
    #[Type('string')]
    public string $name;

    #[NotNull]
    #[Type('int')]
    public int $min_putt_skill;

    #[NotNull]
    #[Type('int')]
    public int $min_throw_power_skill;

    #[NotNull]
    #[Type('int')]
    public int $min_throw_accuracy_skill;

    #[NotNull]
    #[Type('int')]
    public int $min_scramble_skill;

    #[NotNull]
    #[Type('int')]
    public int $max_putt_skill;

    #[NotNull]
    #[Type('int')]
    public int $max_throw_power_skill;

    #[NotNull]
    #[Type('int')]
    public int $max_throw_accuracy_skill;

    #[NotNull]
    #[Type('int')]
    public int $max_scramble_skill;

    /**
     * @return int
     */
    public function getArchetypeId(): int
    {
        return $this->archetype_id;
    }

    /**
     * @param int $archetype_id
     */
    public function setArchetypeId(int $archetype_id): void
    {
        $this->archetype_id = $archetype_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getMinPuttSkill(): int
    {
        return $this->min_putt_skill;
    }

    /**
     * @param int $min_putt_skill
     */
    public function setMinPuttSkill(int $min_putt_skill): void
    {
        $this->min_putt_skill = $min_putt_skill;
    }

    /**
     * @return int
     */
    public function getMinThrowPowerSkill(): int
    {
        return $this->min_throw_power_skill;
    }

    /**
     * @param int $min_throw_power_skill
     */
    public function setMinThrowPowerSkill(int $min_throw_power_skill): void
    {
        $this->min_throw_power_skill = $min_throw_power_skill;
    }

    /**
     * @return int
     */
    public function getMinThrowAccuracySkill(): int
    {
        return $this->min_throw_accuracy_skill;
    }

    /**
     * @param int $min_throw_accuracy_skill
     */
    public function setMinThrowAccuracySkill(int $min_throw_accuracy_skill): void
    {
        $this->min_throw_accuracy_skill = $min_throw_accuracy_skill;
    }

    /**
     * @return int
     */
    public function getMinScrambleSkill(): int
    {
        return $this->min_scramble_skill;
    }

    /**
     * @param int $min_scramble_skill
     */
    public function setMinScrambleSkill(int $min_scramble_skill): void
    {
        $this->min_scramble_skill = $min_scramble_skill;
    }

    /**
     * @return int
     */
    public function getMaxPuttSkill(): int
    {
        return $this->max_putt_skill;
    }

    /**
     * @param int $max_putt_skill
     */
    public function setMaxPuttSkill(int $max_putt_skill): void
    {
        $this->max_putt_skill = $max_putt_skill;
    }

    /**
     * @return int
     */
    public function getMaxThrowPowerSkill(): int
    {
        return $this->max_throw_power_skill;
    }

    /**
     * @param int $max_throw_power_skill
     */
    public function setMaxThrowPowerSkill(int $max_throw_power_skill): void
    {
        $this->max_throw_power_skill = $max_throw_power_skill;
    }

    /**
     * @return int
     */
    public function getMaxThrowAccuracySkill(): int
    {
        return $this->max_throw_accuracy_skill;
    }

    /**
     * @param int $max_throw_accuracy_skill
     */
    public function setMaxThrowAccuracySkill(int $max_throw_accuracy_skill): void
    {
        $this->max_throw_accuracy_skill = $max_throw_accuracy_skill;
    }

    /**
     * @return int
     */
    public function getMaxScrambleSkill(): int
    {
        return $this->max_scramble_skill;
    }

    /**
     * @param int $max_scramble_skill
     */
    public function setMaxScrambleSkill(int $max_scramble_skill): void
    {
        $this->max_scramble_skill = $max_scramble_skill;
    }



}