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
    //not getting the role back
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

    #[Route('api/users', methods: ('POST'))]
    public function createNewUser(Request $request, EntityManagerInterface $entityManager, RoleRepository $roleRepository): Response
    {
        $requestReceived = json_decode($request->getContent(), true);
        $newUser = new User();
        $newUser->setUsername($requestReceived['userName']);
        $newUser->setPassword($requestReceived['password']);

        $userRole = $roleRepository->findOneBy(array('id' => 2));
        var_dump($userRole);
        $newUser->setRole($userRole);

        $entityManager->persist($newUser);
        $entityManager->flush();
        return new JsonResponse();
    }

}
