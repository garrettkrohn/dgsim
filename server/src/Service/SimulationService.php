<?php

namespace App\Service;

use App\Dto\Incoming\CreateTournamentDto;
use App\Dto\Outgoing\HoleResultDto;
use App\Dto\Outgoing\leaderboardDto;
use App\Dto\Outgoing\TournamentResponseDto;
use App\Dto\Outgoing\Transformer\HoleSimResponseDtoTransformer;
use App\Entity\Course;
use App\Entity\HoleResult;
use App\Entity\Player;
use App\Entity\PlayerTournament;
use App\Entity\Round;
use App\Entity\Tournament;
use App\Repository\CourseRepository;
use App\Repository\HoleRepository;
use App\Repository\PlayerRepository;
use App\Repository\PlayerTournamentRepository;
use App\Repository\TournamentRepository;
use App\Service\CourseService;
use App\Service\HoleService;
use App\Service\PlayerService;
use App\Service\Simulation\TournamentBuilder;
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
    private PlayerTournamentRepository $playerTournamentRepository;

    public function __construct(EntityManagerInterface $entityManager, TournamentRepository $tournamentRepository, TournamentBuilder $tournamentBuilder, \App\Service\TournamentService $tournamentService, PlayerTournamentRepository $playerTournamentRepository)
    {
        $this->entityManager = $entityManager;
        $this->tournamentRepository = $tournamentRepository;
        $this->tournamentBuilder = $tournamentBuilder;
        $this->tournamentService = $tournamentService;
        $this->playerTournamentRepository = $playerTournamentRepository;
    }


    public function simulateTournament(CreateTournamentDto $createTournamentDto): TournamentResponseDto
    {
        $tournament = $this->tournamentBuilder->buildTournament($createTournamentDto);
        $this->entityManager->persist($tournament);
        $this->entityManager->flush();
        $lastTournamentObject =  $this->tournamentRepository->findOneBy([],['tournament_id'=>'DESC'],1,0);
        $this->tournamentBuilder->buildLeaderboard($lastTournamentObject->getTournamentId());
        return $this->tournamentService->getTournamentById($lastTournamentObject->getTournamentId());
    }

    public function test(): Response
    {
        $leaderboard = [];

        $lb1 = new leaderboardDto();
        $lb1->score = 216;
        $lb1->playerTournamentId = 393;
        $leaderboard[] = $lb1;

        $lb2 = new leaderboardDto();
        $lb2->score = 216;
        $lb2->playerTournamentId = 392;
        $leaderboard[] = $lb2;

        $playerTournamentArray = [];
        $playerTournamentArray[] = $this->playerTournamentRepository->find($leaderboard[0]->playerTournamentId);
        $playerTournamentArray[] = $this->playerTournamentRepository->find($leaderboard[1]->playerTournamentId);

        $tournament = $this->tournamentRepository->find(68);

        $this->tournamentBuilder->simulationPlayoff($playerTournamentArray, $tournament);

        return new Response('success');
    }
}