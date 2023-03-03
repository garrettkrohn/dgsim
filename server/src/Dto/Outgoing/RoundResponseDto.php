<?php

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class RoundResponseDto
{
    #[NotNull]
    #[Type('int')]
    public int $roundId;

    #[NotNull]
    #[Type('iterable')]
    public iterable $holeResults;

    #[NotNull]
    #[Type('int')]
    public int $roundTotal;

    #[NotNull]
    #[Type('float')]
    public float $luckScore;

    #[NotNull]
    #[Type('string')]
    public string $roundType;

    /**
     * @return int
     */
    public function getRoundId(): int
    {
        return $this->roundId;
    }

    /**
     * @param int $roundId
     */
    public function setRoundId(int $roundId): void
    {
        $this->roundId = $roundId;
    }

    /**
     * @return iterable
     */
    public function getHoleResults(): iterable
    {
        return $this->holeResults;
    }

    /**
     * @param iterable $holeResults
     */
    public function setHoleresults(iterable $holeResults): void
    {
        $this->holeResults = $holeResults;
    }

    /**
     * @return int
     */
    public function getRoundTotal(): int
    {
        return $this->roundTotal;
    }

    /**
     * @param int $roundTotal
     */
    public function setRoundTotal(int $roundTotal): void
    {
        $this->roundTotal = $roundTotal;
    }

    /**
     * @return float
     */
    public function getLuckScore(): float
    {
        return $this->luckScore;
    }

    /**
     * @param float $luckScore
     */
    public function setLuckScore(float $luckScore): void
    {
        $this->luckScore = $luckScore;
    }

    /**
     * @return string
     */
    public function getRoundType(): string
    {
        return $this->roundType;
    }

    /**
     * @param string $roundType
     */
    public function setRoundType(string $roundType): void
    {
        $this->roundType = $roundType;
    }

}