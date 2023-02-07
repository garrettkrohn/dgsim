<?php

namespace App\Controller;

use App\Repository\ArchetypeRepository;
use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends AbstractController
{
    #[Route('api/players', name: 'app_player')]
    public function getAllPlayers(PlayerRepository $playerRepository, ArchetypeRepository $archetypeRepository): Response
    {
        $allPlayers = $playerRepository->findAll();
        $playerArray = [];
        foreach ($allPlayers as $player) {
            $playerArray[] = [
                'id' => $player->getId(),
                'name' => $player->getFirstName() . ' ' . $player->getLastName(),
                'ArchetypeId' => $player->getArchetype()->getId(),
                'ArchetypeName' => $player->getArchetype()->getName()
            ];
        }
        return new JsonResponse($playerArray);
    }
}
