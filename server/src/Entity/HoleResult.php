<?php

namespace App\Entity;

use App\Repository\HoleResultRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoleResultRepository::class)]
class HoleResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $score = null;

    #[ORM\Column]
    private ?int $c1_putts = null;

    #[ORM\Column]
    private ?int $c2_putts = null;

    #[ORM\Column]
    private ?bool $green_in_regulation = null;

    #[ORM\Column]
    private ?bool $scramble = null;

    #[ORM\ManyToOne(inversedBy: 'holeResults')]
    #[ORM\JoinColumn(name: 'round_id', referencedColumnName: 'round_id')]
    private ?round $round = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getC1Putts(): ?int
    {
        return $this->c1_putts;
    }

    public function setC1Putts(int $c1_putts): self
    {
        $this->c1_putts = $c1_putts;

        return $this;
    }

    public function getC2Putts(): ?int
    {
        return $this->c2_putts;
    }

    public function setC2Putts(int $c2_putts): self
    {
        $this->c2_putts = $c2_putts;

        return $this;
    }

    public function isGreenInRegulation(): ?bool
    {
        return $this->green_in_regulation;
    }

    public function setGreenInRegulation(bool $green_in_regulation): self
    {
        $this->green_in_regulation = $green_in_regulation;

        return $this;
    }

    public function isScramble(): ?bool
    {
        return $this->scramble;
    }

    public function setScramble(bool $scramble): self
    {
        $this->scramble = $scramble;

        return $this;
    }

    public function getRound(): ?round
    {
        return $this->round;
    }

    public function setRound(?round $round): self
    {
        $this->round = $round;

        return $this;
    }
}
