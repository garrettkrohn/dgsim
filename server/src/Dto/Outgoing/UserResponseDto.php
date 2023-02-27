<?php

namespace App\Dto\Outgoing;

use App\Entity\Role;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class UserResponseDto
{
    #[NotNull]
    #[Type('int')]
    public int $user_id;

    #[NotNull]
    public RoleResponseDto $role;

    #[NotNull]
    #[Type('string')]
    public string $username;

    #[NotNull]
    #[Type('string')]
    public string $password;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return RoleResponseDto
     */
    public function getRole(): RoleResponseDto
    {
        return $this->role;
    }

    /**
     * @param RoleResponseDto $role
     */
    public function setRole(RoleResponseDto $role): void
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


}