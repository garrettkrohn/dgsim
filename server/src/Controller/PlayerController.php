<?php

namespace App\Controller;

use App\Dto\Response\Transformer\PlayerResponseDtoTransformer;
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
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class PlayerController extends AbstractController
{
    #[Route('api/players', methods: ('GET'))]
    public function getAllPlayers(PlayerRepository $playerRepository, PlayerResponseDtoTransformer $transformer): Response
    {
        $allPlayers = $playerRepository->findAll();
        $allPlayersTransformed = $transformer->transformFromObjects($allPlayers);
        return new JsonResponse($allPlayersTransformed);
    }

    #[Route('api/playersNames', methods: ('GET'))]
    public function getAllPlayerNames(PlayerRepository $playerRepository): Response
    {
        $allPlayers = $playerRepository->findAll();
        $playerNamesArray = [];
        foreach ($allPlayers as $player) {
            $playerNamesArray[] = ['name' => $player->getFirstName() . " " . $player->getLastName()];
        }
        return new JsonResponse($playerNamesArray);
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

    #[Route('api/players/{id}', methods: ('GET'))]
    public function getPlayerById(int $id, PlayerRepository $playerRepository, PlayerResponseDtoTransformer $transformer): Response
    {
        $player = $playerRepository->findOneBy(array('id' => $id));
        $playerTransformed = $transformer->transformFromObject($player);
        return new JsonResponse($playerTransformed);
    }
}
