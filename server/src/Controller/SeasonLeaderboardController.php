<?php

namespace App\Controller;

use App\Service\SeasonLeaderboardService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SeasonLeaderboardController extends AbstractController
{

    private SeasonLeaderboardService $seasonLeaderboardService;

    public function __construct(SeasonLeaderboardService $seasonLeaderboardService)
    {
        $this->seasonLeaderboardService = $seasonLeaderboardService;
    }


    #[Route('api/seasonLeaderboard/{id}', methods: ('GET'))]
    public function getSeasonLeaderboard(int $id) {
       return $this->json($this->seasonLeaderboardService->getSeasonLeaderboard($id));
    }
}