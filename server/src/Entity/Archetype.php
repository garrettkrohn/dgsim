<?php

namespace App\Entity;

use App\Repository\ArchetypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArchetypeRepository::class)]
class Archetype
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column]
    private ?int $archetype_id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $min_putt_skill = null;

    #[ORM\Column]
    private ?int $min_throw_power_skill = null;

    #[ORM\Column]
    private ?int $min_throw_accuracy_skill = null;

    #[ORM\Column]
    private ?int $min_scramble_skill = null;

    #[ORM\Column]
    private ?int $max_putt_skill = null;

    #[ORM\Column]
    private ?int $max_throw_power_skill = null;

    #[ORM\Column]
    private ?int $max_throw_accuracy_skill = null;

    #[ORM\Column]
    private ?int $max_scramble_skill = null;

    #[ORM\OneToMany(mappedBy: 'archetype_id', targetEntity: Player::class)]
    private Collection $Players;

    public function __construct()
    {
        $this->Players = new ArrayCollection();
    }

    public function getArchetypeId(): ?int
    {
        return $this->archetype_id;
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

    public function getMinPuttSkill(): ?int
    {
        return $this->min_putt_skill;
    }

    public function setMinPuttSkill(int $min_putt_skill): self
    {
        $this->min_putt_skill = $min_putt_skill;

        return $this;
    }

    public function getMinThrowPowerSkill(): ?int
    {
        return $this->min_throw_power_skill;
    }

    public function setMinThrowPowerSkill(int $min_throw_power_skill): self
    {
        $this->min_throw_power_skill = $min_throw_power_skill;

        return $this;
    }

    public function getMinThrowAccuracySkill(): ?int
    {
        return $this->min_throw_accuracy_skill;
    }

    public function setMinThrowAccuracySkill(int $min_throw_accuracy_skill): self
    {
        $this->min_throw_accuracy_skill = $min_throw_accuracy_skill;

        return $this;
    }

    public function getMinScrambleSkill(): ?int
    {
        return $this->min_scramble_skill;
    }

    public function setMinScrambleSkill(int $min_scramble_skill): self
    {
        $this->min_scramble_skill = $min_scramble_skill;

        return $this;
    }

    public function getMaxPuttSkill(): ?int
    {
        return $this->max_putt_skill;
    }

    public function setMaxPuttSkill(int $max_putt_skill): self
    {
        $this->max_putt_skill = $max_putt_skill;

        return $this;
    }

    public function getMaxThrowPowerSkill(): ?int
    {
        return $this->max_throw_power_skill;
    }

    public function setMaxThrowPowerSkill(int $max_throw_power_skill): self
    {
        $this->max_throw_power_skill = $max_throw_power_skill;

        return $this;
    }

    public function getMaxThrowAccuracySkill(): ?int
    {
        return $this->max_throw_accuracy_skill;
    }

    public function setMaxThrowAccuracySkill(int $max_throw_accuracy_skill): self
    {
        $this->max_throw_accuracy_skill = $max_throw_accuracy_skill;

        return $this;
    }

    public function getMaxScrambleSkill(): ?int
    {
        return $this->max_scramble_skill;
    }

    public function setMaxScrambleSkill(int $max_scramble_skill): self
    {
        $this->max_scramble_skill = $max_scramble_skill;

        return $this;
    }

    /**
     * @return Collection<int, Player>
     */
    public function getPlayers(): Collection
    {
        return $this->Players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->Players->contains($player)) {
            $this->Players->add($player);
            $player->setArchetypeId($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->Players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getArchetypeId() === $this) {
                $player->setArchetypeId(null);
            }
        }

        return $this;
    }
}
