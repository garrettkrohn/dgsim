<?php

namespace App\Controller;

use App\Dto\Response\Transformer\PlayerResponseDtoTransformer;
use App\Entity\Player;
use App\Repository\ArchetypeRepository;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManager;
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
    private PlayerRepository $playerRepository;
    private ArchetypeRepository $archetypeRepository;
    private EntityManagerInterface $entityManager;
    private PlayerResponseDtoTransformer $transformer;

    public function __construct(PlayerRepository $playerRepository, ArchetypeRepository $archetypeRepository, EntityManagerInterface $entityManager, PlayerResponseDtoTransformer $transformer)
    {
        $this->playerRepository = $playerRepository;
        $this->archetypeRepository = $archetypeRepository;
        $this->entityManager = $entityManager;
        $this->transformer = $transformer;
    }


    #[Route('api/players', methods: ('GET'))]
    public function getAllPlayers(): Response
    {
        $allPlayers = $this->playerRepository->findAll();
        $allPlayersTransformed = $this->transformer->transformFromObjects($allPlayers);
        return new JsonResponse($allPlayersTransformed);
    }

    #[Route('api/playersNames', methods: ('GET'))]
    public function getAllPlayerNames(): Response
    {
        $allPlayers = $this->playerRepository->findAll();
        $playerNamesArray = [];
        foreach ($allPlayers as $player) {
            $playerNamesArray[] = ['name' => $player->getFirstName() . " " . $player->getLastName()];
        }
        return new JsonResponse($playerNamesArray);
    }

    #[Route('api/players', methods: ('POST'))]
    public function createNewPlayer(Request $request): Response
    {
        $request = json_decode($request->getContent(), true);
        $newPlayer = new Player();
        $arch = $this->archetypeRepository->findOneBy(array('name' => $request['archetypeName']));
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

        $this->entityManager->persist($newPlayer);
        $this->entityManager->flush();

        $response = new Response();
        return $response->setStatusCode(Response::HTTP_ACCEPTED);
    }

    #[Route('api/players/{id}', methods: ('GET'))]
    public function getPlayerById(int $id): Response
    {
        $player = $this->playerRepository->findOneBy(array('id' => $id));
        $playerTransformed = $this->transformer->transformFromObject($player);
        return new JsonResponse($playerTransformed);
    }
}
