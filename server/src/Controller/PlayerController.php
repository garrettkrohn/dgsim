<?php

namespace App\Controller;

use App\Dto\Request\Transformer\PlayerRequestDtoTransformer;
use App\Dto\Response\Transformer\PlayerResponseDtoTransformer;
use App\Entity\Player;
use App\Repository\ArchetypeRepository;
use App\Repository\PlayerRepository;
use App\Service\PlayerService;
use App\Service\PlayerTournamentService;
use App\Service\PlayerUpdateService;
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
    private PlayerUpdateService $playerUpdateService;
    private PlayerTournamentService $playerTournamentService;

    public function __construct(PlayerService $playerService, PlayerUpdateService $playerUpdateService, PlayerTournamentService $playerTournamentService)
    {
        $this->playerService = $playerService;
        $this->playerUpdateService = $playerUpdateService;
        $this->playerTournamentService = $playerTournamentService;
    }

    #[Route('api/players', methods: ('GET'))]
    public function getAllPlayers(): Response
    {
        $response = $this->playerService->getAllPlayers();
        return new JsonResponse($response);
    }
//
    #[Route('api/playersNames', methods: ('GET'))]
    public function getAllPlayerNames(): Response
    {
        $response = $this->playerService->getAllPlayerNames();
        return new JsonResponse($response);
    }
//
    #[Route('api/players', methods: ('POST'))]
    public function createNewPlayer(Request $request): Response
    {
        return $this->playerService->createNewPlayer($request);
    }
//
    #[Route('api/players/{id}', methods: ('GET'))]
    public function getPlayerById(int $id): Response
    {
        $response = $this->playerService->getPlayerById($id);
        return new JsonResponse($response);
    }

    #[Route('api/players/update', methods: ('POST'))]
    public function updatePlayer(Request $request): Response
    {
        $return = $this->playerUpdateService->updatePlayer($request);
        return new JsonResponse($return);
    }

    #[Route('api/players/{id}/playerTournaments', methods: ('GET'))]
    public function getAllPlayerTournamentsByPlayerId(int $id): Response
    {
        $return = $this->playerTournamentService->getPlayerTournamentsByPlayerId($id);
        return new JsonResponse($return);
    }

    #[Route('api/players/{id}/updates', methods: ('GET'))]
    public function getAllUpdatesByPlayerId(int $id): Response
    {
        $return = $this->playerUpdateService->getAllUpdatesByPlayerId($id);
        return new JsonResponse($return);
    }


}
