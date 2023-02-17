<?php

namespace App\Service\Simulation;

use App\Dto\Response\HoleResultDto;
use App\Dto\Response\TournamentResponseDto;
use App\Dto\Response\Transformer\HoleSimResponseDtoTransformer;
use App\Entity\Course;
use App\Entity\HoleResult;
use App\Entity\Player;
use App\Entity\PlayerTournament;
use App\Entity\Round;
use App\Entity\Tournament;
use App\Repository\CourseRepository;
use App\Repository\HoleRepository;
use App\Repository\PlayerRepository;
use App\Repository\TournamentRepository;
use App\Service\CourseService;
use App\Service\HoleService;
use App\Service\PlayerService;
use App\Service\TournamentService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class SimulationService
{
    private EntityManagerInterface $entityManager;
    private TournamentRepository $tournamentRepository;
    private TournamentBuilder $tournamentBuilder;
    private TournamentService $tournamentService;

    public function __construct(EntityManagerInterface $entityManager, TournamentRepository $tournamentRepository, TournamentBuilder $tournamentBuilder, TournamentService $tournamentService)
    {
        $this->entityManager = $entityManager;
        $this->tournamentRepository = $tournamentRepository;
        $this->tournamentBuilder = $tournamentBuilder;
        $this->tournamentService = $tournamentService;
    }

    public function simulateTournament(Request $request): TournamentResponseDto
    {
        $tournament = $this->tournamentBuilder->buildTournament($request);
        $this->entityManager->persist($tournament);
        $this->entityManager->flush();
        $lastTournamentObject =  $this->tournamentRepository->findOneBy(array(),array('tournament_id'=>'DESC'),1,0);
        $this->tournamentBuilder->buildLeaderboard($lastTournamentObject->getTournamentId());
        return $this->tournamentService->getTournamentById($lastTournamentObject->getTournamentId());
    }
}