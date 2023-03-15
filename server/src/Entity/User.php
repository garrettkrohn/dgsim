<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'role_id', referencedColumnName: 'role_id')]
    private ?Role $role = null;

    #[ORM\OneToMany(mappedBy: 'playerUser', targetEntity: Player::class)]
    #[ORM\JoinColumn(name: 'player_id', referencedColumnName: 'player_id')]
    private Collection $player;

    #[ORM\Column]
    private string $auth0;

    public function __construct()
    {
        $this->player = new ArrayCollection();
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, Player>
     */
    public function getPlayer(): Collection
    {
        return $this->player;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->player->contains($player)) {
            $this->player->add($player);
            $player->setPlayerUser($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->player->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getPlayerUser() === $this) {
                $player->setPlayerUser(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getAuth0(): string
    {
        return $this->auth0;
    }

    /**
     * @param string $auth0
     */
    public function setAuth0(string $auth0): void
    {
        $this->auth0 = $auth0;
    }

}
