<?php

namespace App\Dto\Response;

use App\Entity\Role;

class UserResponseDto
{
    public int $user_id;
    public RoleResponseDto $role;
    public string $username;
    public string $password;
}