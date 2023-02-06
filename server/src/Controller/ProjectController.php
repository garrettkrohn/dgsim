<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    #[Route('/project', name: 'app_project')]
    public function index(): Response
    {
        $user = new User();
        $user->setUserId(1);
        $user->setUsername('username 1');
        $user->setPassword('password');
        $userRole = new Role();
        $user->setRole($userRole);
        return $this->json($user);
    }

}
