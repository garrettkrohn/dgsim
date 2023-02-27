<?php

namespace App\Controller;

use App\Dto\Request\PlayerRequestDto;
use App\Dto\Request\Transformer\PlayerRequestDtoTransformer;
use App\Dto\Response\Transformer\PlayerResponseDtoTransformer;
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
    private PlayerRequestDtoTransformer $playerRequestDtoTransformer;
    private PlayerResponseDtoTransformer $playerResponseDtoTransformer;

    public function __construct(PlayerService $playerService, PlayerUpdateService $playerUpdateService,
                                PlayerTournamentService $playerTournamentService, PlayerRequestDtoTransformer $playerRequestDtoTransformer,
                                PlayerResponseDtoTransformer $playerResponseDtoTransformer, SerializationService $serializationService)
    {
        parent::__construct($serializationService);
        $this->playerService = $playerService;
        $this->playerUpdateService = $playerUpdateService;
        $this->playerTournamentService = $playerTournamentService;
        $this->playerRequestDtoTransformer = $playerRequestDtoTransformer;
        $this->playerResponseDtoTransformer = $playerResponseDtoTransformer;
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
        /** @var PlayerRequestDto $playerRequestDto */
        $dto = $this->getValidatedDto($request, PlayerRequestDto::class);
        // working on implementing this.
       return $this->json($this->playerService->createNewPlayer($dto));
    }

    #[Route('api/players/{id}', methods: ('GET'))]
    public function getPlayerById(int $id): Response
    {
        $response = $this->playerService->getPlayerById($id);
        return new JsonResponse($response);
    }

    #[Route('api/players/{id}/update', methods: ('POST'))]
    public function updatePlayer(Request $request, int $id): Response
    {
        $player = $this->playerRequestDtoTransformer->transformFromObject($request);
        $return = $this->playerUpdateService->updatePlayer($player, $id);
        $returnPlayer = $this->playerResponseDtoTransformer->transformFromObject($return);
        return new JsonResponse($returnPlayer);
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
