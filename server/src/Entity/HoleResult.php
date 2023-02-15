<?php

namespace App\Entity;

use App\Repository\HoleResultRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoleResultRepository::class)]
class HoleResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column]
    private ?int $hole_result_id = null;

    #[ORM\Column]
    private ?int $score = null;

    #[ORM\Column]
    private ?int $c1_putts = null;

    #[ORM\Column]
    private ?int $c2_putts = null;

    #[ORM\Column]
    private ?bool $parked = null;

    #[ORM\Column]
    private ?bool $c1_in_regulation = null;

    #[ORM\Column]
    private ?bool $c2_in_regulation = null;

    #[ORM\Column]
    private ?bool $scramble = null;

    #[ORM\ManyToOne(inversedBy: 'holeResults')]
    #[ORM\JoinColumn(name: 'round_id', referencedColumnName: 'round_id')]
    private ?Round $round = null;

    #[ORM\Column]
    private ?float $luck = null;

    #[ORM\ManyToOne(inversedBy: 'holeResults')]
    #[ORM\JoinColumn(name: "hole_id", referencedColumnName: "hole_id")]
    private ?Hole $hole = null;

    public function getHoleresultId(): ?int
    {
        return $this->hole_result_id;
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

    public function isParked(): ?bool
    {
        return $this->parked;
    }

    public function setParked(bool $parked): self
    {
        $this->parked = $parked;

        return $this;
    }

    public function isC1InRegulation(): ?bool
    {
        return $this->c1_in_regulation;
    }

    public function setC1InRegulation(bool $c1_in_regulation): self
    {
        $this->c1_in_regulation = $c1_in_regulation;

        return $this;
    }

    public function isC2InRegulation(): ?bool
    {
        return $this->c2_in_regulation;
    }

    public function setC2InRegulation(bool $c2_in_regulation): self
    {
        $this->c2_in_regulation = $c2_in_regulation;

        return $this;
    }

    public function getLuck(): ?float
    {
        return $this->luck;
    }

    public function setLuck(float $luck): self
    {
        $this->luck = $luck;

        return $this;
    }

    public function getHole(): ?Hole
    {
        return $this->hole;
    }

    public function setHole(?Hole $hole): self
    {
        $this->hole = $hole;

        return $this;
    }
}
