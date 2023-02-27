<?php

namespace App\Service;

use App\Dto\Incoming\Transformer\UserRequestDtoTransformer;
use App\Dto\Outgoing\Transformer\UserResponseDtoTransformer;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserService
{
    private UserRepository $userRepository;
    private EntityManagerInterface $entityManager;
    private UserResponseDtoTransformer $userResponseDtoTransformer;
    private UserRequestDtoTransformer $userRequestDtoTransformer;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager, UserResponseDtoTransformer $userResponseDtoTransformer, UserRequestDtoTransformer $userRequestDtoTransformer)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
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