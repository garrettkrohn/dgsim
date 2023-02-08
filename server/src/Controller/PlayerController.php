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
                'putt_skill' => $player->getPuttSkill(),
                'throw_power_skill' => $player->getThrowPowerSkill(),
                'throw_accuracy_skill' => $player->getThrowAccuracySkill(),
                'scramble_skill' => $player->getScrambleSkill(),
                'start_season' => $player->getStartSeason(),
                'is_active' => $player->isIsActive(),
                'banked_skill_points' => $player->getBankedSkillPoints()
            ];
        }
        return new JsonResponse($playerArray);
    }

    #[Route('api/players', methods: ('POST'))]
    public function createNewPlayer(Request $request, ArchetypeRepository $archetypeRepository, EntityManagerInterface $entityManager): Response
    {
        $request = json_decode($request->getContent(), true);
        $newPlayer = new Player();
        $arch = $archetypeRepository->findOneBy(array('name' => $request['archetypeName']));
        $newPlayer->setArchetype($arch);
        $newPlayer->setFirstName($request['firstName']);
        $newPlayer->setLastName($request['lastName']);
        $newPlayer->setPuttSkill($request['puttSkill']);
        $newPlayer->setThrowPowerSkill($request['throwPowerSkill']);
        $newPlayer->setThrowAccuracySkill($request['throwAccuracySkill']);
        $newPlayer->setScrambleSkill($request['scrambleSkill']);
        $newPlayer->setStartSeason($request['startSeason']);
        $newPlayer->setIsActive(true);
        $newPlayer->setBankedSkillPoints(0);

        $entityManager->persist($newPlayer);
        $entityManager->flush();

        $response = new Response();
        return $response->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
