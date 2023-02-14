<?php

namespace App\Service\Simulation;

use App\Dto\Response\HoleResultDto;
use App\Dto\Response\Transformer\HoleResponseDtoTransformer;
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
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class SimulationService
{
    private CourseRepository $courseRepository;
    private PlayerService $playerService;
    private PlayerIngester $playerIngester;
    private HoleRepository $holeRepository;
    private HoleResponseDtoTransformer $transformer;
    private SimulationIterators $iterators;
    private CourseService $courseService;
    private HoleService $holeService;
    private EntityManagerInterface $entityManager;
    private TournamentRepository $tournamentRepository;
    private PlayerRepository $playerRepository;

    /**
     * @param CourseRepository $courseRepository
     * @param PlayerService $playerService
     * @param PlayerIngester $playerIngester
     * @param HoleRepository $holeRepository
     * @param HoleResponseDtoTransformer $transformer
     * @param SimulationIterators $iterators
     * @param CourseService $courseService
     * @param HoleService $holeService
     * @param EntityManagerInterface $entityManager
     * @param TournamentRepository $tournamentRepository
     * @param PlayerRepository $playerRepository
     */
    public function __construct(CourseRepository $courseRepository, PlayerService $playerService, PlayerIngester $playerIngester, HoleRepository $holeRepository, HoleResponseDtoTransformer $transformer, SimulationIterators $iterators, CourseService $courseService, HoleService $holeService, EntityManagerInterface $entityManager, TournamentRepository $tournamentRepository, PlayerRepository $playerRepository)
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
    }


    public function simulateTournament(): iterable
    {
        $tournament = new Tournament();
        $tournament->setName('test tournament 1');
        $course = $this->courseService->getCourseById(3);
        $tournament->setCourse($course);
        $tournament->setSeason(1);
        //successfully converted all players to playersimobjects
        $allPlayerSimObjects = $this->playerService->getActivePlayerSimObjects();

        //hard coded for now

        //transform the holes
        $allHolesSimObjects = $this->holeService->getAllSimHoles(3);

        $holeResults = $this->iterators->playerIterator($allPlayerSimObjects, $allHolesSimObjects);

        return $holeResults;
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