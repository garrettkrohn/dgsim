<?php

namespace App\Controller;

use App\Dto\Request\Transformer\PlayerRequestDtoTransformer;
use App\Dto\Response\Transformer\PlayerResponseDtoTransformer;
use App\Entity\Player;
use App\Repository\ArchetypeRepository;
use App\Repository\PlayerRepository;
use App\Service\PlayerService;
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
    private PlayerService $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    #[Route('api/players', methods: ('GET'))]
    public function getAllPlayers(): Response
    {
//        $allPlayers = $this->playerRepository->findAll();
//        $allPlayersTransformed = $this->transformer->transformFromObjects($allPlayers);
        $response = $this->playerService->getAllPlayers();
        return new JsonResponse($response);
    }
//
//    #[Route('api/playersNames', methods: ('GET'))]
//    public function getAllPlayerNames(): Response
//    {
//        $allPlayers = $this->playerRepository->findAll();
//        $playerNamesArray = [];
//        foreach ($allPlayers as $player) {
//            $playerNamesArray[] = ['name' => $player->getFirstName() . " " . $player->getLastName()];
//        }
//        return new JsonResponse($playerNamesArray);
//    }
//
//    #[Route('api/players', methods: ('POST'))]
//    public function createNewPlayer(Request $request): Response
//    {
//        $newPlayer = $this->playerRequestDtoTransformer->transformObject($request);
//        $this->entityManager->persist($newPlayer);
//        $this->entityManager->flush();
//
//        $response = new Response();
//        return $response->setStatusCode(Response::HTTP_ACCEPTED);
//    }
//
//    #[Route('api/players/{id}', methods: ('GET'))]
//    public function getPlayerById(int $id): Response
//    {
//        $player = $this->playerRepository->findOneBy(array('id' => $id));
//        $playerTransformed = $this->transformer->transformFromObject($player);
//        return new JsonResponse($playerTransformed);
//    }
}
