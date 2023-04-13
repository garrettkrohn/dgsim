<?php

namespace App\Dto\Incoming;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class UpdateAvatarColors
{
    #[NotNull]
    #[Type('string')]
    private string $auth0;

    #[NotNull]
    #[Type('string')]
    private string $avatarBackgroundColor;

    #[NotNull]
    #[Type('string')]
    private string $avatarTextColor;

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



}