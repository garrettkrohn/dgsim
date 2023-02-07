<?php

namespace App\Controller;

use App\Entity\Player;
use App\Repository\ArchetypeRepository;
use App\Repository\PlayerRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonDecode;

class PlayerController extends AbstractController
{
    #[Route('api/players', methods: ('GET'))]
    public function getAllPlayers(PlayerRepository $playerRepository,): Response
    {
        $allPlayers = $playerRepository->findAll();
        $playerArray = [];
        foreach ($allPlayers as $player) {
            $playerArray[] = [
                'id' => $player->getId(),
                'name' => $player->getFirstName() . ' ' . $player->getLastName(),
                'ArchetypeId' => $player->getArchetype()->getId(),
                'ArchetypeName' => $player->getArchetype()->getName(),
            ];
        }
        return new JsonResponse($playerArray);
    }

    #[Route('api/players', methods: ('POST'))]
    public function createNewPlayer(Request $request): Response
    {
        $receivedNewPlayer = json_decode($request->getContent(), true);
        return new JsonResponse($receivedNewPlayer);
    }
}
