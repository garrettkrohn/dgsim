<?php

namespace App\Controller;

use App\Service\Simulation\SimulationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SimulationController extends AbstractController
{

    private SimulationService $simulationService;

    public function __construct(SimulationService $simulationService)
    {
        $this->simulationService = $simulationService;
    }


    #[Route('api/runSimulation', methods: ('POST'))]
    public function runSimulation():Response
    {
//        $response = $this->simulationService->simulateTournament();
        $response = $this->simulationService->testPersistence();
        return new JsonResponse($response);
    }
}