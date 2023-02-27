<?php

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class RoundResponseDto
{
    #[NotNull]
    #[Type('int')]
    public int $round_id;

    #[NotNull]
    #[Type('iterable')]
    public iterable $hole_results;

    #[NotNull]
    #[Type('int')]
    public int $round_total;

    #[NotNull]
    #[Type('float')]
    public float $luck_score;

    #[NotNull]
    #[Type('string')]
    public string $round_type;

    /**
     * @return int
     */
    public function getRoundId(): int
    {
        return $this->round_id;
    }

    /**
     * @param int $round_id
     */
    public function setRoundId(int $round_id): void
    {
        $this->round_id = $round_id;
    }

    /**
     * @return iterable
     */
    public function getHoleresults(): iterable
    {
        return $this->hole_results;
    }

    /**
     * @param iterable $hole_results
     */
    public function setHoleresults(iterable $hole_results): void
    {
        $this->hole_results = $hole_results;
    }

    /**
     * @return int
     */
    public function getRoundTotal(): int
    {
        return $this->round_total;
    }

    /**
     * @param int $round_total
     */
    public function setRoundTotal(int $round_total): void
    {
        $this->round_total = $round_total;
    }

    /**
     * @return float
     */
    public function getLuckScore(): float
    {
        return $this->luck_score;
    }

    /**
     * @param float $luck_score
     */
    public function setLuckScore(float $luck_score): void
    {
        $this->luck_score = $luck_score;
    }

    /**
     * @return string
     */
    public function getRoundType(): string
    {
        return $this->round_type;
    }

    /**
     * @param string $round_type
     */
    public function setRoundType(string $round_type): void
    {
        $this->round_type = $round_type;
    }

}