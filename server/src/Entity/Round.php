<?php

namespace App\Entity;

use App\Repository\RoundRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoundRepository::class)]
class Round
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $player_id = null;

    #[ORM\Column]
    private ?int $course_id = null;

    #[ORM\Column]
    private ?int $round_hole_result_id = null;

    #[ORM\Column(length: 255)]
    private ?int $round_total = null;

    #[ORM\Column]
    private ?int $luck_score = null;

    #[ORM\ManyToOne(inversedBy: 'round_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Player $player = null;

    #[ORM\OneToMany(mappedBy: 'round_id', targetEntity: HoleResult::class)]
    private Collection $holeResults;

    public function __construct()
    {
        $this->holeResults = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayerId(): ?int
    {
        return $this->player_id;
    }

    public function setPlayerId(int $player_id): self
    {
        $this->player_id = $player_id;

        return $this;
    }

    public function getCourseId(): ?int
    {
        return $this->course_id;
    }

    public function setCourseId(int $course_id): self
    {
        $this->course_id = $course_id;

        return $this;
    }

    public function getRoundHoleResultId(): ?int
    {
        return $this->round_hole_result_id;
    }

    public function setRoundHoleResultId(int $round_hole_result_id): self
    {
        $this->round_hole_result_id = $round_hole_result_id;

        return $this;
    }

    public function getRoundTotal(): ?int
    {
        return $this->round_total;
    }

    public function setRoundTotal(int $round_total): self
    {
        $this->round_total = $round_total;

        return $this;
    }

    public function getLuckScore(): ?int
    {
        return $this->luck_score;
    }

    public function setLuckScore(int $luck_score): self
    {
        $this->luck_score = $luck_score;

        return $this;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    /**
     * @return Collection<int, HoleResult>
     */
    public function getHoleResults(): Collection
    {
        return $this->holeResults;
    }

    public function addHoleResult(HoleResult $holeResult): self
    {
        if (!$this->holeResults->contains($holeResult)) {
            $this->holeResults->add($holeResult);
            $holeResult->setRoundId($this);
        }

        return $this;
    }

    public function removeHoleResult(HoleResult $holeResult): self
    {
        if ($this->holeResults->removeElement($holeResult)) {
            // set the owning side to null (unless already changed)
            if ($holeResult->getRoundId() === $this) {
                $holeResult->setRoundId(null);
            }
        }

        return $this;
    }
}
