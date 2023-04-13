<?php

namespace App\Dto\Outgoing;

use App\Entity\Role;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class UserResponseDto
{
    #[NotNull]
    #[Type('int')]
    public int $userid;

    #[NotNull]
    public RoleResponseDto $role;

    #[NotNull]
    #[Type('string')]
    public string $auth0;

    #[NotNull]
    public PlayerDto $player;

    #[NotNull]
    #[Type('string')]
    public string $backgroundColor;

    #[NotNull]
    #[Type('string')]
    public string $foregroundColor;

    #[NotNull]
    #[Type('string')]
    public string $avatarBackgroundColor;

    #[NotNull]
    #[Type('string')]
    public string $avatarTextColor;

    /**
     * @return string
     */
    public function getBackgroundColor(): string
    {
        return $this->backgroundColor;
    }

    /**
     * @param string $backgroundColor
     */
    public function setBackgroundColor(string $backgroundColor): void
    {
        $this->backgroundColor = $backgroundColor;
    }

    /**
     * @return string
     */
    public function getForegroundColor(): string
    {
        return $this->foregroundColor;
    }

    /**
     * @param string $foregroundColor
     */
    public function setForegroundColor(string $foregroundColor): void
    {
        $this->foregroundColor = $foregroundColor;
    }

    /**
     * @return string
     */
    public function getAvatarBackgroundColor(): string
    {
        return $this->avatarBackgroundColor;
    }

    /**
     * @param string $avatarBackgroundColor
     */
    public function setAvatarBackgroundColor(string $avatarBackgroundColor): void
    {
        $this->avatarBackgroundColor = $avatarBackgroundColor;
    }

    /**
     * @return string
     */
    public function getAvatarTextColor(): string
    {
        return $this->avatarTextColor;
    }

    /**
     * @param string $avatarTextColor
     */
    public function setAvatarTextColor(string $avatarTextColor): void
    {
        $this->avatarTextColor = $avatarTextColor;
    }



    /**
     * @return PlayerDto
     */
    public function getPlayer(): PlayerDto
    {
        return $this->player;
    }

    /**
     * @param PlayerDto $player
     */
    public function setPlayer(PlayerDto $player): void
    {
        $this->player = $player;
    }

    /**
     * @return int
     */
    public function getUserid(): int
    {
        return $this->userid;
    }

    /**
     * @param int $userid
     */
    public function setUserid(int $userid): void
    {
        $this->userid = $userid;
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