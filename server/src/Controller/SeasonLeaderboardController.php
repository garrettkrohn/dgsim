<?php

namespace App\Controller;

use App\Service\SeasonLeaderboardService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeasonLeaderboardController extends AbstractController
{

    private SeasonLeaderboardService $seasonLeaderboardService;

    public function __construct(SeasonLeaderboardService $seasonLeaderboardService)
    {
        $this->seasonLeaderboardService = $seasonLeaderboardService;
    }

    #[Route('api/leaderboards/career', methods: ('GET'))]
    public function getSeasonLeaderboard(): Response {
       return $this->json($this->seasonLeaderboardService->getCareerLeaderboard());
    }

//    public function getAllSeasonLeaderboards(): Response {
//        return $this->json($this->seasonLeaderboardService->)
//    }


}