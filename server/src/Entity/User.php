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
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column(length: 25)]
    private ?string $username = null;

    #[ORM\Column(length: 25)]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'role_id', targetEntity: Role::class)]
    private Collection $role_id;

    public function __construct()
    {
        $this->role_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getRoleId(): Collection
    {
        return $this->role_id;
    }

    public function addRoleId(Role $roleId): self
    {
        if (!$this->role_id->contains($roleId)) {
            $this->role_id->add($roleId);
            $roleId->setRoleId($this);
        }

        return $this;
    }

    public function removeRoleId(Role $roleId): self
    {
        if ($this->role_id->removeElement($roleId)) {
            // set the owning side to null (unless already changed)
            if ($roleId->getRoleId() === $this) {
                $roleId->setRoleId(null);
            }
        }

        return $this;
    }
}
