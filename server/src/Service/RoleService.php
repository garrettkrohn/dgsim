<?php

namespace App\Service;

use App\Dto\Outgoing\RoleResponseDto;
use App\Entity\Role;
use App\Repository\RoleRepository;

class RoleService extends AbstractMultiTransformer
{
    private RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }


    /**
     * @param Role $object
     * @return RoleResponseDto
     */
    public function transformFromObject($object): RoleResponseDto
    {
         $dto = new RoleResponseDto();
         $dto->setRoleId($object->getRoleId());
         $dto->setName($object->getRoleId());

         return $dto;
    }

    public function getRoleDto(int $id): RoleResponseDto
    {
        $role = $this->roleRepository->find($id);
        return $this->transformFromObject($role);
    }

    public function getRole(int $id): Role{
        return $this->roleRepository->find($id);
    }

}