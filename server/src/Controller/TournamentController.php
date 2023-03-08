<?php

namespace App\Controller;

use App\Dto\Incoming\CreateTournamentDto;
use App\Exception\InvalidRequestDataException;
use App\Serialization\SerializationService;
use App\Service\SimulationService;
use App\Service\TournamentService;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TournamentController extends ApiController
{
    private TournamentService $tournamentService;
    private SimulationService $simulationService;
    private SerializationService $serializationService;

    /**
     * @param TournamentService $tournamentService
     * @param SimulationService $simulationService
     * @param SerializationService $serializationService
     */
    public function __construct(TournamentService $tournamentService, SimulationService $simulationService, SerializationService $serializationService)
    {
        $this->tournamentService = $tournamentService;
        $this->simulationService = $simulationService;
        $this->serializationService = $serializationService;
        parent::__construct($serializationService);

    }

    #[Route('api/tournaments', methods: ('GET'))]
    public function getAllTournaments(): Response
    {
        return $this->json($this->tournamentService->getAllTournaments());
    }

    /**
     * @throws InvalidRequestDataException
     * @throws JsonException
     */
    #[Route('api/tournaments', methods: ('POST'))]
    public function runSimulation(Request $request):Response
    {
        /** @var CreateTournamentDto $dto */
        $dto = $this->getValidatedDto($request, CreateTournamentDto::class);
        return $this->json($this->simulationService->simulateTournament($dto));
    }

    #[Route('api/tournaments/{id}', methods: ('GET'))]
    public function getTournamentById(int $id):Response
    {
        return $this->json($this->tournamentService->getTournamentById($id));
    }

    #[Route('api/tournaments/seasons/{id}', methods: ('GET'))]
    public function getTournamentsBySeason(int $id): Response
    {
        return $this->json($this->tournamentService->getTournamentsBySeason($id));
    }

    #[Route('api/tournaments', methods: ('DELETE'))]
    public function deleteAllTournaments():Response
    {
        return $this->json($this->tournamentService->deleteAllTournaments());
    }

    #[Route('api/tournaments/{id}', methods: ('DELETE'))]
    public function deleteTournamentById(int $id):Response
    {
        return $this->json($this->tournamentService->deleteTournamentById($id));

    }

    #[Route('api/test', methods: ('GET'))]
    public function test(): Response
    {
        $return = $this->simulationService->test();
        return new JsonResponse($return);
    }

    #[Route('api/seasons', methods: ('GET'))]
    public function getAvailableSeasons(): Response
    {
        return $this->json($this->tournamentService->getAvailableSeasons());
    }

    #[Route('api/tournaments/titles/{id}', methods: ('GET'))]
    public function getTournamentTitles(int $id): Response
    {
        return $this->json($this->tournamentService->getTournamentTitles($id));
    }

    #[Route('api/lastTournament/{playerId}')]
    public function getMostRecentPlayerTournament(int $playerId): Response
    {
        return $this->json($this->tournamentService->getLastPlayerTournament($playerId));
    }

}