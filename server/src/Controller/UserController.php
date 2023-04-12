<?php

namespace App\Controller;

use App\Dto\Incoming\CreatePlayerDto;
use App\Dto\Incoming\CreateUserDto;
use App\Dto\Incoming\UpdateUserColors;
use App\Entity\Role;
use App\Entity\User;
use App\Exception\InvalidRequestDataException;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use App\Serialization\SerializationService;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use JsonException as JsonExceptionAlias;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends ApiController
{
    private UserService $userService;
    private SerializationService $serializationService;


    public function __construct(UserService $userService, SerializationService $serializationService)
    {
        parent::__construct($serializationService);
        $this->userService = $userService;
    }


    #[Route('/api/users', methods: ['GET'])]
    public function returnAllUsers(): Response
    {
        return $this->json($this->userService->getAllUsers());
    }

    /**
     * @throws JsonExceptionAlias
     * @throws InvalidRequestDataException
     */
    #[Route('api/users', methods: ('POST'))]
    public function getOrCreateUser(Request $request): Response
    {
        /** @var CreateUserDto $dto */
        $dto = $this->getValidatedDto($request, CreateUserDto::class);
        $response = $this->userService->getOrCreateUser($dto);
        return new JsonResponse($response);
    }

    #[Route('/api/users/{id}', methods: ['GET'])]
    public function getUserById(int $id): Response
    {
        return $this->json($this->userService->getUserDtoById($id));
    }

    #[Route('/api/users/{id}', methods: ['DELETE'])]
    public function deleteUserById(int $id): Response
    {
        return $this->json($this->userService->deleteUser($id));
    }

    /**
     * @throws JsonExceptionAlias
     * @throws InvalidRequestDataException
     */
    #[Route('/api/users/colors', methods: ['POST'])]
    public function updateUserColors(Request $request): Response
    {
        /** @var UpdateUserColors $dto */
        $dto = $this->getValidatedDto($request, UpdateUserColors::class);
        return $this->json($this->userService->updateUserColors($dto));

    }

}
