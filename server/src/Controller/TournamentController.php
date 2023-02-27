<?php

namespace App\Controller;

use App\Dto\Incoming\CreateTournamentDto;
use App\Serialization\SerializationService;
use App\Service\SimulationService;
use App\Service\TournamentService;
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
}