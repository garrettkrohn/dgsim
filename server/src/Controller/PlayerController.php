<?php

namespace App\Controller;

use App\Dto\Incoming\CreatePlayerDto;
use App\Dto\Incoming\CreateUserDto;
use App\Dto\Incoming\UpdatePlayerDto;
use App\Exception\InvalidRequestDataException;
use App\Serialization\SerializationService;
use App\Service\ArchetypeService;
use App\Service\PlayerService;
use App\Service\PlayerTournamentService;
use App\Service\PlayerUpdateService;
use GuzzleHttp\Promise\Create;
use JsonException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends ApiController
{
    private PlayerService $playerService;
    private PlayerUpdateService $playerUpdateService;
    private PlayerTournamentService $playerTournamentService;
    private SerializationService $serializationService;
    private ArchetypeService $archetypeService;

    public function __construct(PlayerService $playerService, PlayerUpdateService $playerUpdateService,
                                PlayerTournamentService $playerTournamentService, SerializationService $serializationService,
                                ArchetypeService $archetypeService)
    {
        parent::__construct($serializationService);
        $this->playerService = $playerService;
        $this->playerUpdateService = $playerUpdateService;
        $this->playerTournamentService = $playerTournamentService;
        $this->archetypeService = $archetypeService;
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
     * @throws JsonException
     * @throws InvalidRequestDataException
     */
    #[Route('api/playersAuth', methods: ('POST'))]
    public function getPlayerByAuth0(Request $request): Response
    {
        /** @var CreateUserDto $dto */
        $dto = $this->getValidatedDto($request, CreateUserDto::class);
        return $this->json($this->playerService->getPlayerByAuth($dto->getAuth0()));
    }

    /**
     * @throws InvalidRequestDataException
     * @throws JsonException
     */
    #[Route('api/players', methods: ('PUT'))]
    public function updatePlayer(Request $request): Response
    {
        /** @var UpdatePlayerDto $dto */
        $dto = $this->getValidatedDto($request, UpdatePlayerDto::class);
        return $this->json($this->playerUpdateService->updatePlayer($dto));
    }

    #[Route('api/players/{id}/playerTournaments', methods: ('GET'))]
    public function getAllPlayerTournamentsByPlayerId(int $id): Response
    {
        return $this->json($this->playerTournamentService->getPlayerTournamentsByPlayerIdDto($id));
    }

    #[Route('api/players/{id}/updates', methods: ('GET'))]
    public function getAllUpdatesByPlayerId(int $id): Response
    {
        return $this->json($this->playerUpdateService->getAllUpdatesByPlayerId($id));
    }

    #[Route('api/archetypes', methods: ('GET'))]
    public function getAllArchetypes(): Response
    {
        return $this->json($this->archetypeService->getAllArchetypes());
    }

    #[Route('api/replenish', methods: ('GET'))]
    public function replenishBank(): Response
    {
        return $this->json($this->playerService->replenishBank());
    }

}
