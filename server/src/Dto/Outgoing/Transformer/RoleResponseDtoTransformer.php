<?php

namespace App\Dto\Outgoing\Transformer;

use App\Dto\Outgoing\RoleResponseDto;
use App\Entity\Role;

class RoleResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    /**
     * @param Role $role
     * @return void
     */
    public function transformFromObject($role): RoleResponseDto
    {
        $dto = new RoleResponseDto();
        $dto->role_id = $role->getRoleId();
        $dto->name = $role->getName();

        return $dto;
    }
}