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
    public string $email;

    #[NotNull]
    #[Type('string')]
    public string $auth0;

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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
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