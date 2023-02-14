<?php

namespace App\Entity;

use App\Repository\PlayerTournamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerTournamentRepository::class)]
#[ORM\Table(name: 'player_tournament')]
class PlayerTournament
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column]
    private ?int $player_tournament_id = null;

    #[ORM\ManyToOne(inversedBy: 'player_tournament')]
    #[ORM\JoinColumn(name: 'tournament_id', referencedColumnName: 'tournament_id')]
    private ?Tournament $tournament = null;

    #[ORM\OneToMany(mappedBy: 'player_tournament', targetEntity: Player::class)]
    private Collection $player_id;

    #[ORM\OneToMany(mappedBy: 'player_tournament_id', targetEntity: Round::class, cascade: ['persist', 'remove'])]
    private Collection $round_id;

    #[ORM\Column]
    private ?int $tour_points = null;

    #[ORM\Column]
    private ?int $total_score = null;

    #[ORM\Column]
    private ?float $luck_score = null;

    #[ORM\Column(nullable: true)]
    private ?int $place = null;

    public function __construct()
    {
        $this->player_id = new ArrayCollection();
        $this->round_id = new ArrayCollection();
    }

    public function getPlayerTournamentId(): ?int
    {
        return $this->player_tournament_id;
    }

    /**
     * @return Collection<int, Player>
     */
    public function getPlayerId(): Collection
    {
        return $this->player_id;
    }

    public function addPlayerId(Player $playerId): self
    {
        if (!$this->player_id->contains($playerId)) {
            $this->player_id->add($playerId);
            $playerId->setPlayerTournament($this);
        }

        return $this;
    }

    public function removePlayerId(Player $playerId): self
    {
        if ($this->player_id->removeElement($playerId)) {
            // set the owning side to null (unless already changed)
            if ($playerId->getPlayerTournament() === $this) {
                $playerId->setPlayerTournament(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Round>
     */
    public function getRoundId(): Collection
    {
        return $this->round_id;
    }

    public function addRoundId(Round $roundId): self
    {
        if (!$this->round_id->contains($roundId)) {
            $this->round_id->add($roundId);
            $roundId->setPlayerTournament($this);
        }

        return $this;
    }

    public function removeRoundId(Round $roundId): self
    {
        if ($this->round_id->removeElement($roundId)) {
            // set the owning side to null (unless already changed)
            if ($roundId->getPlayerTournament() === $this) {
                $roundId->setPlayerTournament(null);
            }
        }

        return $this;
    }

    public function getTourPoints(): ?int
    {
        return $this->tour_points;
    }

    public function setTourPoints(int $tour_points): self
    {
        $this->tour_points = $tour_points;

        return $this;
    }

    public function getTournament(): ?Tournament
    {
        return $this->tournament;
    }

    public function setTournament(?Tournament $tournament): self
    {
        $this->tournament = $tournament;

        return $this;
    }

    public function getTotalScore(): ?int
    {
        return $this->total_score;
    }

    public function setTotalScore(int $total_score): self
    {
        $this->total_score = $total_score;

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

    public function getPlace(): ?int
    {
        return $this->place;
    }

    public function setPlace(?int $place): self
    {
        $this->place = $place;

        return $this;
    }
}
