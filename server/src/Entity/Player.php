<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column]
    private ?int $player_id = null;

    #[ORM\Column(length: 25)]
    private ?string $first_name = null;

    #[ORM\Column(length: 25)]
    private ?string $last_name = null;

    #[ORM\Column]
    private ?int $putt_skill = null;

    #[ORM\Column]
    private ?int $throw_power_skill = null;

    #[ORM\Column]
    private ?int $throw_accuracy_skill = null;

    #[ORM\Column]
    private ?int $scramble_skill = null;

    #[ORM\Column]
    private ?int $start_season = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\Column]
    private ?int $banked_skill_points = null;

    #[ORM\OneToMany(mappedBy: 'player', targetEntity: Round::class)]
    #[ORM\JoinColumn(name: 'round_id', referencedColumnName: 'round_id')]
    private Collection $round_id;

    #[ORM\ManyToOne(inversedBy: 'Players')]
    #[ORM\JoinColumn(name: "archetype_id", referencedColumnName: "archetype_id")]
    private ?Archetype $archetype = null;

    public function __construct()
    {
        $this->round_id = new ArrayCollection();
    }

    public function getPlayerId(): ?int
    {
        return $this->player_id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getPuttSkill(): ?int
    {
        return $this->putt_skill;
    }

    public function setPuttSkill(int $putt_skill): self
    {
        $this->putt_skill = $putt_skill;

        return $this;
    }

    public function getThrowPowerSkill(): ?int
    {
        return $this->throw_power_skill;
    }

    public function setThrowPowerSkill(int $throw_power_skill): self
    {
        $this->throw_power_skill = $throw_power_skill;

        return $this;
    }

    public function getThrowAccuracySkill(): ?int
    {
        return $this->throw_accuracy_skill;
    }

    public function setThrowAccuracySkill(int $throw_accuracy_skill): self
    {
        $this->throw_accuracy_skill = $throw_accuracy_skill;

        return $this;
    }

    public function getScrambleSkill(): ?int
    {
        return $this->scramble_skill;
    }

    public function setScrambleSkill(int $scramble_skill): self
    {
        $this->scramble_skill = $scramble_skill;

        return $this;
    }

    public function getStartSeason(): ?int
    {
        return $this->start_season;
    }

    public function setStartSeason(int $start_season): self
    {
        $this->start_season = $start_season;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getBankedSkillPoints(): ?int
    {
        return $this->banked_skill_points;
    }

    public function setBankedSkillPoints(int $banked_skill_points): self
    {
        $this->banked_skill_points = $banked_skill_points;

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
            $roundId->setPlayer($this);
        }

        return $this;
    }

    public function removeRoundId(round $roundId): self
    {
        if ($this->round_id->removeElement($roundId)) {
            // set the owning side to null (unless already changed)
            if ($roundId->getPlayer() === $this) {
                $roundId->setPlayer(null);
            }
        }

        return $this;
    }

    public function getArchetype(): ?Archetype
    {
        return $this->archetype;
    }

    public function setArchetype(?Archetype $archetype): self
    {
        $this->archetype = $archetype;

        return $this;
    }
}
