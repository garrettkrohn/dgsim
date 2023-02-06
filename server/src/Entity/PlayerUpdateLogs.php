<?php

namespace App\Entity;

use App\Repository\PlayerUpdateLogsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerUpdateLogsRepository::class)]
class PlayerUpdateLogs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $update_time = null;

    #[ORM\Column]
    private ?int $player_id = null;

    #[ORM\Column]
    private ?int $putt_increment = null;

    #[ORM\Column]
    private ?int $throw_power_increment = null;

    #[ORM\Column]
    private ?int $throw_accuracy_increment = null;

    #[ORM\Column]
    private ?int $scramble_increment = null;

    #[ORM\Column]
    private ?int $previous_bank = null;

    #[ORM\Column]
    private ?int $post_bank = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUpdateTime(): ?\DateTimeInterface
    {
        return $this->update_time;
    }

    public function setUpdateTime(\DateTimeInterface $update_time): self
    {
        $this->update_time = $update_time;

        return $this;
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

    public function getPuttIncrement(): ?int
    {
        return $this->putt_increment;
    }

    public function setPuttIncrement(int $putt_increment): self
    {
        $this->putt_increment = $putt_increment;

        return $this;
    }

    public function getThrowPowerIncrement(): ?int
    {
        return $this->throw_power_increment;
    }

    public function setThrowPowerIncrement(int $throw_power_increment): self
    {
        $this->throw_power_increment = $throw_power_increment;

        return $this;
    }

    public function getThrowAccuracyIncrement(): ?int
    {
        return $this->throw_accuracy_increment;
    }

    public function setThrowAccuracyIncrement(int $throw_accuracy_increment): self
    {
        $this->throw_accuracy_increment = $throw_accuracy_increment;

        return $this;
    }

    public function getScrambleIncrement(): ?int
    {
        return $this->scramble_increment;
    }

    public function setScrambleIncrement(int $scramble_increment): self
    {
        $this->scramble_increment = $scramble_increment;

        return $this;
    }

    public function getPreviousBank(): ?int
    {
        return $this->previous_bank;
    }

    public function setPreviousBank(int $previous_bank): self
    {
        $this->previous_bank = $previous_bank;

        return $this;
    }

    public function getPostBank(): ?int
    {
        return $this->post_bank;
    }

    public function setPostBank(int $post_bank): self
    {
        $this->post_bank = $post_bank;

        return $this;
    }
}
