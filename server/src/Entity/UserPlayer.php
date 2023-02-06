<?php

namespace App\Entity;

use App\Repository\UserPlayerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserPlayerRepository::class)]
class UserPlayer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user_id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?player $player_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?user
    {
        return $this->user_id;
    }

    public function setUserId(?user $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getPlayerId(): ?player
    {
        return $this->player_id;
    }

    public function setPlayerId(player $player_id): self
    {
        $this->player_id = $player_id;

        return $this;
    }
}
