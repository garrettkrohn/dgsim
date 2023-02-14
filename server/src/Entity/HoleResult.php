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
    private ?round $round = null;

    #[ORM\OneToMany(mappedBy: 'holeResult', targetEntity: hole::class)]
    #[ORM\JoinColumn(name: 'hole_id', referencedColumnName: 'hole_id')]
    private Collection $hole_id;

    public function __construct()
    {
        $this->hole_id = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, hole>
     */
    public function getHoleId(): Collection
    {
        return $this->hole_id;
    }

    public function addHoleId(hole $holeId): self
    {
        if (!$this->hole_id->contains($holeId)) {
            $this->hole_id->add($holeId);
            $holeId->setHoleResult($this);
        }

        return $this;
    }

    public function removeHoleId(hole $holeId): self
    {
        if ($this->hole_id->removeElement($holeId)) {
            // set the owning side to null (unless already changed)
            if ($holeId->getHoleResult() === $this) {
                $holeId->setHoleResult(null);
            }
        }

        return $this;
    }
}
