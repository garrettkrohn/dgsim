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
    private ?int $round_id = null;

    #[ORM\Column(length: 255)]
    private ?int $round_total = null;

    #[ORM\Column]
    private ?float $luck_score = null;

    #[ORM\OneToMany(mappedBy: 'round', targetEntity: HoleResult::class, cascade: ['persist', 'remove'])]
    private ?Collection $holeResults = null;

    #[ORM\ManyToOne(inversedBy: 'round_id')]
//    #[ORM\JoinColumn(nullable: false)]
    #[ORM\JoinColumn(name: "player_tournament_id", referencedColumnName: "player_tournament_id")]
    private ?PlayerTournament $player_tournament = null;

    public function __construct()
    {
        $this->holeResults = new ArrayCollection();
    }

    public function getRoundId(): ?int
    {
        return $this->round_id;
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

    public function getLuckScore(): ?float
    {
        return $this->luck_score;
    }

    public function setLuckScore(float $luck_score): self
    {
        $this->luck_score = $luck_score;

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
            $holeResult->setRound($this);
        }

        return $this;
    }

    public function removeHoleResult(HoleResult $holeResult): self
    {
        if ($this->holeResults->removeElement($holeResult)) {
            // set the owning side to null (unless already changed)
            if ($holeResult->getRound() === $this) {
                $holeResult->setRound(null);
            }
        }

        return $this;
    }

    public function getPlayerTournament(): ?PlayerTournament
    {
        return $this->player_tournament;
    }

    public function setPlayerTournament(?PlayerTournament $player_tournament_id): self
    {
        $this->player_tournament = $player_tournament_id;

        return $this;
    }
}
