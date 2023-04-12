<?php

namespace App\Dto\Incoming;

class UpdateUserColors
{
    private string $auth0;
    private string $backgroundColor;
    private string $foregroundColor;
    private string $avatarBackground;
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
    public function getAvatarBackground(): string
    {
        return $this->avatarBackground;
    }

    /**
     * @param string $avatarBackground
     */
    public function setAvatarBackground(string $avatarBackground): void
    {
        $this->avatarBackground = $avatarBackground;
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