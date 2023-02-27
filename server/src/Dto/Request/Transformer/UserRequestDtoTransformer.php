<?php

namespace App\Dto\Request\Transformer;

use App\Dto\Request\UserRequestDto;
use App\Entity\User;
use App\Repository\RoleRepository;
use Symfony\Component\HttpFoundation\Request;

class UserRequestDtoTransformer extends AbstractRequestDtoTransformer
{
    private RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function transformFromObject($object): User
    {
        $request = json_decode($object->getContent(), true);
        $newUser = new User();
        $newUser->setUsername($request['username']);
        $newUser->setPassword($request['password']);
        $userRole = $this->roleRepository->findOneBy(array('name' => 'user'));
        $newUser->setRole($userRole);

        return $newUser;
    }

}