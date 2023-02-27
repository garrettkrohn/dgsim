<?php

namespace App\Service;

use App\Dto\Incoming\Transformer\UserRequestDtoTransformer;
use App\Dto\Incoming\CreateUserDto;
use App\Dto\Outgoing\Transformer\UserResponseDtoTransformer;
use App\Dto\Outgoing\UserResponseDto;
use App\Entity\User;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserService extends AbstractMultiTransformer
{
    private UserRepository $userRepository;
    private EntityManagerInterface $entityManager;
    private UserResponseDtoTransformer $userResponseDtoTransformer;
    private UserRequestDtoTransformer $userRequestDtoTransformer;
    private RoleService $roleService;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager, UserResponseDtoTransformer $userResponseDtoTransformer, UserRequestDtoTransformer $userRequestDtoTransformer, RoleService $roleService)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->userResponseDtoTransformer = $userResponseDtoTransformer;
        $this->userRequestDtoTransformer = $userRequestDtoTransformer;
        $this->roleService = $roleService;
    }

    public function getAllUsers(): iterable
    {
        $allUsers = $this->userRepository->findAll();
        return $this->transformFromObjects($allUsers);
    }

    public function createNewUser(CreateUserDto $createUserDto): UserResponseDto
    {
        $newUser = new User();
        $newUser->setUsername($createUserDto->getUsername());
        $newUser->setPassword($createUserDto->getPassword());
        $role = $this->roleService->getRole(2);
        $newUser->setRole($role);

        $this->entityManager->persist($newUser);
        $this->entityManager->flush();

        return $this->transformFromObject($newUser);
    }

    /**
     * @param User $object
     * @return UserResponseDto
     */
    public function transformFromObject($object): UserResponseDto
    {
        $dto = new UserResponseDto();
        $role = $this->roleService->getRoleDto($object->getRole()->getRoleId());
        $dto->setUserId($object->getUserId());
        $dto->setUsername($object->getUsername());
        $dto->setPassword($object->getPassword());
        $dto->setRole($role);
        return $dto;
    }


}