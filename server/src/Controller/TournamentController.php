<?php

namespace App\Controller;

use App\Service\SimulationService;
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
        return $this->json($this->tournamentService->getAllTournaments());
    }

    #[Route('api/tournaments', methods: ('POST'))]
    public function runSimulation(Request $request):Response
    {
        return $this->json($this->simulationService->simulateTournament($request));
    }

    #[Route('api/tournaments/{id}', methods: ('GET'))]
    public function getTournamentById(int $id):Response
    {
        $response = $this->tournamentService->getTournamentById($id);
        return new JsonResponse($response);
    }

    #[Route('api/tournaments', methods: ('DELETE'))]
    public function deleteAllTournaments():Response
    {
        $this->tournamentService->deleteAllTournaments();
        $response = new Response();
        $response->setStatusCode(200);
        return new JsonResponse($response);
    }

    #[Route('api/tournaments/{id}', methods: ('DELETE'))]
    public function deleteTournamentById(int $id):Response
    {
        $this->tournamentService->deleteTournamentById($id);
        $response = new Response();
        $response->setStatusCode(200);
        return new JsonResponse($response);
    }

    #[Route('api/test', methods: ('GET'))]
    public function test(): Response
    {
        $return = $this->simulationService->test();
        return new JsonResponse($return);
    }
}