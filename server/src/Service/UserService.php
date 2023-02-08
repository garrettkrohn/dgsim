<?php

namespace App\Service;

use App\Dto\Response\Transformer\UserResponseDtoTransformer;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class UserService
{
    private UserRepository $userRepository;
    private EntityManagerInterface $entityManager;
    private RoleRepository $roleRepository;
    private UserResponseDtoTransformer $userResponseDtoTransformer;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager, RoleRepository $roleRepository, UserResponseDtoTransformer $userResponseDtoTransformer)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->roleRepository = $roleRepository;
        $this->userResponseDtoTransformer = $userResponseDtoTransformer;
    }


    public function getAllUsers(): iterable
    {
        $allUsers = $this->userRepository->findAll();
        return $this->userResponseDtoTransformer->transformFromObjects($allUsers);
    }
}