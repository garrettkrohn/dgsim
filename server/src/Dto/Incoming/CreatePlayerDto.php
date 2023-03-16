<?php

namespace App\Dto\Incoming;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;


class CreatePlayerDto
{
    #[NotNull]
    #[Type('string')]
    public string $firstName;

    #[NotNull]
    #[Type('string')]
    public string $lastName;

    #[NotNull]
    #[Type('int')]
    public int $puttSkill;

    #[NotNull]
    #[Type('int')]
    public int $throwPowerSkill;

    #[NotNull]
    #[Type('int')]
    public int $throwAccuracySkill;

    #[NotNull]
    #[Type('int')]
    public int $scrambleSkill;

    #[NotNull]
    #[Type('int')]
    public int $startSeason;

    #[NotNull]
    #[Type('int')]
    public int $archetypeId;

    #[NotNull]
    #[Type('int')]
    public int $bankedSkillPoints;

    #[NotNull]
    #[Type('string')]
    public string $auth0;

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return int
     */
    public function getPuttSkill(): int
    {
        return $this->puttSkill;
    }

    /**
     * @param int $puttSkill
     */
    public function setPuttSkill(int $puttSkill): void
    {
        $this->puttSkill = $puttSkill;
    }

    /**
     * @return int
     */
    public function getThrowPowerSkill(): int
    {
        return $this->throwPowerSkill;
    }

    /**
     * @param int $throwPowerSkill
     */
    public function setThrowPowerSkill(int $throwPowerSkill): void
    {
        $this->throwPowerSkill = $throwPowerSkill;
    }

    /**
     * @return int
     */
    public function getThrowAccuracySkill(): int
    {
        return $this->throwAccuracySkill;
    }

    /**
     * @param int $throwAccuracySkill
     */
    public function setThrowAccuracySkill(int $throwAccuracySkill): void
    {
        $this->throwAccuracySkill = $throwAccuracySkill;
    }

    /**
     * @return int
     */
    public function getScrambleSkill(): int
    {
        return $this->scrambleSkill;
    }

    /**
     * @param int $scrambleSkill
     */
    public function setScrambleSkill(int $scrambleSkill): void
    {
        $this->scrambleSkill = $scrambleSkill;
    }

    /**
     * @return int
     */
    public function getStartSeason(): int
    {
        return $this->startSeason;
    }

    /**
     * @param int $startSeason
     */
    public function setStartSeason(int $startSeason): void
    {
        $this->startSeason = $startSeason;
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
        return $this->bankedSkillPoints;
    }

    /**
     * @param int $bankedSkillPoints
     */
    public function setBankedSkillPoints(int $bankedSkillPoints): void
    {
        $this->bankedSkillPoints = $bankedSkillPoints;
    }

    /**
     * @return string
     */
    public function getAuth0(): string
    {
        return $this->auth0;
    }

    /**
     * @param string $auth0
     */
    public function setAuth0(string $auth0): void
    {
        $this->auth0 = $auth0;
    }



}
