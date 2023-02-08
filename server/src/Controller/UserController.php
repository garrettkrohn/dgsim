<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    #[Route('/api/users', methods: ['GET'])]
    public function returnAllUsers(): Response
    {
        $allUsers = $this->userService->getAllUsers();
        return new JsonResponse($allUsers);
    }

    #[Route('api/users', methods: ('POST'))]
    public function createNewUser(Request $request): Response
    {
        $response = $this->userService->createNewUser($request);
        return new JsonResponse($response);
    }

//    #[Route('/api/users/{id}', methods: ['GET'])]
//    public function getUserById(int $id, UserRepository $userRepository): Response
//    {
//        $returnUser = $userRepository->findOneBy(array('id' => $id));
//        $newUser = ['username' => $returnUser->getUsername()];
//
//        return new JsonResponse($newUser);
//    }
//
//    #[Route('/api/users/{id}', methods: ['DELETE'])]
//    public function deleteUserById(int $id, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
//    {
//        $returnUser = $userRepository->findOneBy(array('id' => $id));
//        $entityManager->remove($returnUser);
//        $entityManager->flush();
//
//        $response = new Response();
//        return $response->setStatusCode(RESPONSE::HTTP_ACCEPTED);
//    }

}
