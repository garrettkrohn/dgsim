<?php

namespace App\Controller;

use App\Entity\Player;
use App\Repository\ArchetypeRepository;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function createNewPlayer(Request $request, ArchetypeRepository $archetypeRepository, EntityManagerInterface $entityManager): Response
    {
        $request = json_decode($request->getContent(), true);
        $newPlayer = new Player();
        $arch = $archetypeRepository->findOneBy(array('id' => 1));
        $newPlayer->setArchetype($arch);
        $newPlayer->setFirstName('Ricky');
        $newPlayer->setLastName('Wysocki');
        $newPlayer->setPuttSkill(100);
        $newPlayer->setThrowPowerSkill(100);
        $newPlayer->setThrowAccuracySkill(100);
        $newPlayer->setScrambleSkill(100);
        $newPlayer->setStartSeason(1);
        $newPlayer->setIsActive(true);
        $newPlayer->setBankedSkillPoints(0);

        $entityManager->persist($newPlayer);
        $entityManager->flush();

        $response = new Response();
        return $response->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
