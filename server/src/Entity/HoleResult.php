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
    private ?int $holeResultId = null;

    #[ORM\Column]
    private ?int $score = null;

    #[ORM\Column]
    private ?int $c1Putts = null;

    #[ORM\Column]
    private ?int $c2Putts = null;

    #[ORM\Column]
    private ?bool $parked = null;

    #[ORM\Column]
    private ?bool $c1InRegulation = null;

    #[ORM\Column]
    private ?bool $c2InRegulation = null;

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

    public function getHoleResultId(): ?int
    {
        return $this->holeResultId;
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
        return $this->c1Putts;
    }

    public function setC1Putts(int $c1Putts): self
    {
        $this->c1Putts = $c1Putts;

        return $this;
    }

    public function getC2Putts(): ?int
    {
        return $this->c2Putts;
    }

    public function setC2Putts(int $c2Putts): self
    {
        $this->c2Putts = $c2Putts;

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
        return $this->c1InRegulation;
    }

    public function setC1InRegulation(bool $c1InRegulation): self
    {
        $this->c1InRegulation = $c1InRegulation;

        return $this;
    }

    public function isC2InRegulation(): ?bool
    {
        return $this->c2InRegulation;
    }

    public function setC2InRegulation(bool $c2InRegulation): self
    {
        $this->c2InRegulation = $c2InRegulation;

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
