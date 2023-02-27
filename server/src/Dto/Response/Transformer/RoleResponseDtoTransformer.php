<?php

namespace App\Dto\Response\Transformer;

use App\Dto\Response\RoleResponseDto;
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