<?php

namespace App\Service;

use App\Dto\Request\Transformer\UserRequestDtoTransformer;
use App\Dto\Response\Transformer\UserResponseDtoTransformer;
use App\Entity\User;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserService
{
    private UserRepository $userRepository;
    private EntityManagerInterface $entityManager;
    private RoleRepository $roleRepository;
    private UserResponseDtoTransformer $userResponseDtoTransformer;
    private UserRequestDtoTransformer $userRequestDtoTransformer;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager, RoleRepository $roleRepository, UserResponseDtoTransformer $userResponseDtoTransformer, UserRequestDtoTransformer $userRequestDtoTransformer)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->roleRepository = $roleRepository;
        $this->userResponseDtoTransformer = $userResponseDtoTransformer;
        $this->userRequestDtoTransformer = $userRequestDtoTransformer;
    }


    public function getAllUsers(): iterable
    {
        $allUsers = $this->userRepository->findAll();
        return $this->userResponseDtoTransformer->transformFromObjects($allUsers);
    }

    public function createNewUser(Request $request): Response
    {
        $newUser = $this->userRequestDtoTransformer->transformFromObject($request);

        $this->entityManager->persist($newUser);
        $this->entityManager->flush();

        $response = new Response();
        return $response->setStatusCode(Response::HTTP_ACCEPTED);
    }
}