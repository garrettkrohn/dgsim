<?php

namespace App\Entity;

use App\Repository\TournamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TournamentRepository::class)]
class Tournament
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column]
    private ?int $tournament_id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $season = null;

    #[ORM\ManyToOne(inversedBy: 'Tournaments')]
    #[ORM\JoinColumn(name: 'course_id', referencedColumnName: 'course_id')]
    private ?Course $course = null;

    #[ORM\OneToMany(mappedBy: 'tournament', targetEntity: PlayerTournament::class, cascade: ['persist', 'remove'])]
    private Collection $player_tournament;

    public function __construct()
    {
        $this->player_tournament = new ArrayCollection();
    }

    public function getTournamentId(): ?int
    {
        return $this->tournament_id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSeason(): ?int
    {
        return $this->season;
    }

    public function setSeason(int $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->course;
    }

    public function setCourse(?Course $course): self
    {
        $this->course = $course;

        return $this;
    }

    /**
     * @return Collection<int, PlayerTournament>
     */
    public function getPlayerTournament(): Collection
    {
        return $this->player_tournament;
    }

    public function addPlayerTournament(PlayerTournament $playerTournament): self
    {
        if (!$this->player_tournament->contains($playerTournament)) {
            $this->player_tournament->add($playerTournament);
            $playerTournament->setTournament($this);
        }

        return $this;
    }

    public function removePlayerTournament(PlayerTournament $playerTournament): self
    {
        if ($this->player_tournament->removeElement($playerTournament)) {
            // set the owning side to null (unless already changed)
            if ($playerTournament->getTournament() === $this) {
                $playerTournament->setTournament(null);
            }
        }

        return $this;
    }
}
