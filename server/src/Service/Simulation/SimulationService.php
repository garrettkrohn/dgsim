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
    private CourseRepository $courseRepository;
    private PlayerService $playerService;
    private PlayerIngester $playerIngester;
    private HoleRepository $holeRepository;
    private HoleSimResponseDtoTransformer $transformer;
    private SimulationIterators $iterators;
    private CourseService $courseService;
    private HoleService $holeService;
    private EntityManagerInterface $entityManager;
    private TournamentRepository $tournamentRepository;
    private PlayerRepository $playerRepository;
    private TournamentBuilder $tournamentBuilder;
    private TournamentService $tournamentService;

    /**
     * @param CourseRepository $courseRepository
     * @param PlayerService $playerService
     * @param PlayerIngester $playerIngester
     * @param HoleRepository $holeRepository
     * @param HoleSimResponseDtoTransformer $transformer
     * @param SimulationIterators $iterators
     * @param CourseService $courseService
     * @param HoleService $holeService
     * @param EntityManagerInterface $entityManager
     * @param TournamentRepository $tournamentRepository
     * @param PlayerRepository $playerRepository
     * @param TournamentBuilder $tournamentBuilder
     * @param TournamentService $tournamentService
     */
    public function __construct(CourseRepository $courseRepository, PlayerService $playerService, PlayerIngester $playerIngester, HoleRepository $holeRepository, HoleSimResponseDtoTransformer $transformer, SimulationIterators $iterators, CourseService $courseService, HoleService $holeService, EntityManagerInterface $entityManager, TournamentRepository $tournamentRepository, PlayerRepository $playerRepository, TournamentBuilder $tournamentBuilder, TournamentService $tournamentService)
    {
        $this->courseRepository = $courseRepository;
        $this->playerService = $playerService;
        $this->playerIngester = $playerIngester;
        $this->holeRepository = $holeRepository;
        $this->transformer = $transformer;
        $this->iterators = $iterators;
        $this->courseService = $courseService;
        $this->holeService = $holeService;
        $this->entityManager = $entityManager;
        $this->tournamentRepository = $tournamentRepository;
        $this->playerRepository = $playerRepository;
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

    public function testPersistence(): iterable
    {
        $tournament = new Tournament();
        $tournament->setName('test tournament 2');
        $course = $this->courseService->getCourseById(3);
        $tournament->setCourse($course);
        $tournament->setSeason(2);

        $holeResultsReturn = array();
        $holeResult = new HoleResult();
        $holeResult->setScore(1);
        $holeResult->setC1Putts(1);
        $holeResult->setC2Putts(1);
        $holeResult->setParked(true);
        $holeResult->setC1InRegulation(true);
        $holeResult->setC2InRegulation(true);
        $holeResult->setScramble(true);

        $holeResultsReturn[] = $holeResult;

        $holeResult2 = new HoleResult();
        $holeResult2->setScore(1);
        $holeResult2->setC1Putts(1);
        $holeResult2->setC2Putts(1);
        $holeResult2->setParked(true);
        $holeResult2->setC1InRegulation(true);
        $holeResult2->setC2InRegulation(true);
        $holeResult2->setScramble(true);

        $round = new Round();
        $round->setRoundTotal(1);
        $round->setLuckScore(1);
        $round->addHoleResult($holeResult);
        $round->addHoleResult($holeResult2);


//        $tournament = $this->tournamentRepository->find(1);
        $playerTournament = new PlayerTournament();
        $playerTournament->setTournament($tournament);

        $player = $this->playerRepository->find(1);
        $playerTournament->addPlayerId($player);
        $playerTournament->setTourPoints(100);
        $playerTournament->addRoundId($round);

        $tournament->addPlayerTournament($playerTournament);

        $this->entityManager->persist($tournament);
        $this->entityManager->flush();

        return $holeResultsReturn;
    }
}