<?php

namespace App\Entity;

use App\Repository\UserPlayerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserPlayerRepository::class)]
class UserPlayer
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column]
    private ?int $user_player_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'user_id')]
    private ?user $user = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: 'player_id', referencedColumnName: 'player_id')]
    private ?player $player = null;

    public function getUserplayerId(): ?int
    {
        return $this->user_player_id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPlayer(): ?player
    {
        return $this->player;
    }

    public function setPlayerId(player $player): self
    {
        $this->player = $player;

        return $this;
    }
}
