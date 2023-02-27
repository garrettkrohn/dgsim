<?php

namespace App\Controller;

use App\Dto\Incoming\CreatePlayerDto;
use App\Dto\Incoming\Transformer\PlayerRequestDtoTransformer;
use App\Dto\Incoming\UpdatePlayerDto;
use App\Dto\Outgoing\Transformer\PlayerResponseDtoTransformer;
use App\Entity\Player;
use App\Exception\InvalidRequestDataException;
use App\Repository\ArchetypeRepository;
use App\Repository\PlayerRepository;
use App\Serialization\SerializationService;
use App\Service\PlayerService;
use App\Service\PlayerTournamentService;
use App\Service\PlayerUpdateService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use JsonException;
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

class PlayerController extends ApiController
{
    private PlayerService $playerService;
    private PlayerUpdateService $playerUpdateService;
    private PlayerTournamentService $playerTournamentService;
    private SerializationService $serializationService;

    /**
     * @param PlayerService $playerService
     * @param PlayerUpdateService $playerUpdateService
     * @param PlayerTournamentService $playerTournamentService
     * @param SerializationService $serializationService
     */
    public function __construct(PlayerService $playerService, PlayerUpdateService $playerUpdateService,
                                PlayerTournamentService $playerTournamentService, SerializationService $serializationService)
    {
        parent::__construct($serializationService);
        $this->playerService = $playerService;
        $this->playerUpdateService = $playerUpdateService;
        $this->playerTournamentService = $playerTournamentService;
    }


    #[Route('api/players', methods: ('GET'))]
    public function getAllPlayers(): Response {
        return $this->json($this->playerService->getAllPlayers());
    }

    #[Route('api/playersNames', methods: ('GET'))]
    public function getAllPlayerNames(): Response {
        return $this->json($this->playerService->getAllPlayerNames());
    }

    /**
     * @throws JsonException
     * @throws InvalidRequestDataException
     */
    #[Route('api/players', methods: ('POST'))]
    public function createNewPlayer(Request $request): Response{
        /** @var CreatePlayerDto $dto */
        $dto = $this->getValidatedDto($request, CreatePlayerDto::class);
       return $this->json($this->playerService->createNewPlayer($dto));
    }

    #[Route('api/players/{id}', methods: ('GET'))]
    public function getPlayerById(int $id): Response
    {
        return $this->json($this->playerService->getPlayerByIdDto($id));
    }

    /**
     * @throws InvalidRequestDataException
     * @throws JsonException
     */
    #[Route('api/players/', methods: ('PUT'))]
    public function updatePlayer(Request $request): Response
    {
        /** @var UpdatePlayerDto $dto */
        $dto = $this->getValidatedDto($request, UpdatePlayerDto::class);
        return $this->json($this->playerUpdateService->updatePlayer($dto));
    }

    #[Route('api/players/{id}/playerTournaments', methods: ('GET'))]
    public function getAllPlayerTournamentsByPlayerId(int $id): Response
    {
        return $this->json($this->playerTournamentService->getPlayerTournamentsByPlayerId($id));
    }

    #[Route('api/players/{id}/updates', methods: ('GET'))]
    public function getAllUpdatesByPlayerId(int $id): Response
    {
        return $this->json($this->playerUpdateService->getAllUpdatesByPlayerId($id));
    }



}
