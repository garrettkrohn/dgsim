<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    //not getting the role back
    #[Route('/api/users', methods: ['GET'])]
    public function returnAllUsers(UserRepository $userRepository, RoleRepository $roleRepository): Response
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



}
