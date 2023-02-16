<?php

namespace App\Controller;

use App\Service\Simulation\SimulationService;
use App\Service\TournamentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TournamentController extends AbstractController
{
    private TournamentService $tournamentService;
    private SimulationService $simulationService;

    /**
     * @param TournamentService $tournamentService
     * @param SimulationService $simulationService
     */
    public function __construct(TournamentService $tournamentService, SimulationService $simulationService)
    {
        $this->tournamentService = $tournamentService;
        $this->simulationService = $simulationService;
    }


    #[Route('api/tournaments', methods: ('GET'))]
    public function getAllTournaments(): Response
    {
        $response = $this->tournamentService->getAllTournaments();
        return new JsonResponse($response);
    }

    #[Route('api/tournaments', methods: ('POST'))]
    public function runSimulation(Request $request):Response
    {
        $response = $this->simulationService->simulateTournament($request);
        return new JsonResponse($response);
    }

    #[Route('api/tournaments/{id}', methods: ('GET'))]
    public function getTournamentById(int $id):Response
    {
        $response = $this->tournamentService->getTournamentById($id);
        return new JsonResponse($response);
    }

}