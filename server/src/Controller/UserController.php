<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/api/users', methods: ['GET'])]
    public function returnAllUsers(UserRepository $userRepository): Response
    {
        $allUsers = $userRepository->findAll();
        $userArray = [];
        foreach ($allUsers as $user) {
            $userArray[] = ['id' =>$user->getId(),
                'username' => $user->getUsername(),
                'password' => $user->getPassword(),
                'roleId' => $user->getRole()->getId(),
                'roleName' => $user->getRole()->getName()
            ];
        }
        return new JsonResponse($userArray);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param RoleRepository $roleRepository
     * @return Response
     * Request body needs to include userName and password
     */
    #[Route('api/users', methods: ('POST'))]
    public function createNewUser(Request $request, EntityManagerInterface $entityManager, RoleRepository $roleRepository): Response
    {
        $requestReceived = json_decode($request->getContent(), true);
        $newUser = new User();
        $newUser->setUsername($requestReceived['userName']);
        $newUser->setPassword($requestReceived['password']);

        $userRole = $roleRepository->findOneBy(array('id' => 2));
        $newUser->setRole($userRole);

        $entityManager->persist($newUser);
        $entityManager->flush();
        return new JsonResponse();
    }

    #[Route('/api/users/{id}', methods: ['GET'])]
    public function getUserById(int $id, UserRepository $userRepository): Response
    {
        $returnUser = $userRepository->findOneBy(array('id' => $id));
        $newUser = ['username' => $returnUser->getUsername()];

        return new JsonResponse($newUser);
    }

    #[Route('/api/users/{id}', methods: ['DELETE'])]
    public function deleteUserById(int $id, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $returnUser = $userRepository->findOneBy(array('id' => $id));
        $entityManager->remove($returnUser);
        $entityManager->flush();

        $response = new Response();
        return $response->setStatusCode(RESPONSE::HTTP_ACCEPTED);
    }

}
