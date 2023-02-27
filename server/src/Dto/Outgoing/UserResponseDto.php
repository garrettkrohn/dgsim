<?php

namespace App\Dto\Outgoing;

use App\Entity\Role;

class UserResponseDto
{
    public int $user_id;
    public RoleResponseDto $role;
    public string $username;
    public string $password;
}