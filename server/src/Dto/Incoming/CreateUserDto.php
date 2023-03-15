<?php

namespace App\Dto\Incoming;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class CreateUserDto
{
    #[NotNull]
    #[Type('string')]
    public string $email;

    #[NotNull]
    #[Type('string')]
    public string $auth0;

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