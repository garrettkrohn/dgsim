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

    #[ORM\OneToMany(mappedBy: 'player_tournament_id', targetEntity: round::class, cascade: ['persist', 'remove'])]
    private Collection $round_id;

    #[ORM\Column]
    private ?int $tour_points = null;

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
     * @return Collection<int, round>
     */
    public function getRoundId(): Collection
    {
        return $this->round_id;
    }

    public function addRoundId(round $roundId): self
    {
        if (!$this->round_id->contains($roundId)) {
            $this->round_id->add($roundId);
            $roundId->setPlayerTournament($this);
        }

        return $this;
    }

    public function removeRoundId(round $roundId): self
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
}
