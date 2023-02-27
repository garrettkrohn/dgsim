<?php

namespace App\Controller;

use App\Entity\PlayerTournament;
use App\Service\CourseService;
use App\Service\HoleService;
use App\Service\PlayerService;
use App\Service\PlayerTournamentService;
use App\Service\PlayerUpdateService;
use App\Service\SeasonLeaderboardService;
use App\Service\SimulationService;
use App\Service\TournamentService;
use App\Service\UserService;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Controller\Preprocessing\RequireAuthControllerInterface;
use App\Controller\Preprocessing\RequireValidJsonControllerInterface;
use App\Exception\InvalidRequestDataException;
use App\Serialization\JsonSerializer;
use App\Validation\ObjectValidator;

abstract class StandardController implements RequireAuthControllerInterface, RequireValidJsonControllerInterface
{
    protected LoggerInterface $logger;
    private JsonSerializer $jsonSerializer;
    private ObjectValidator $objectValidator;
    protected CourseService $courseService;
    protected HoleService $holeService;
    protected PlayerService $playerService;
    protected PlayerTournamentService $playerTournamentService;
    protected PlayerUpdateService $playerUpdateService;
    protected SeasonLeaderboardService $seasonLeaderboardService;
    protected SimulationService $simulationService;
    protected TournamentService $tournamentService;
    protected UserService $userService;

    public function __construct(LoggerInterface $logger, JsonSerializer $jsonSerializer, ObjectValidator $objectValidator, CourseService $courseService, HoleService $holeService, PlayerService $playerService, PlayerTournamentService $playerTournamentService, PlayerUpdateService $playerUpdateService, SeasonLeaderboardService $seasonLeaderboardService, SimulationService $simulationService, TournamentService $tournamentService, UserService $userService)
    {
        $this->logger = $logger;
        $this->jsonSerializer = $jsonSerializer;
        $this->objectValidator = $objectValidator;
        $this->courseService = $courseService;
        $this->holeService = $holeService;
        $this->playerService = $playerService;
        $this->playerTournamentService = $playerTournamentService;
        $this->playerUpdateService = $playerUpdateService;
        $this->seasonLeaderboardService = $seasonLeaderboardService;
        $this->simulationService = $simulationService;
        $this->tournamentService = $tournamentService;
        $this->userService = $userService;
    }


    protected function getValidatedEntity(Request $request, string $class): object
    {
        /** @var string $requestContent */
        $requestContent = $request->getContent();
        $entity = $this->jsonSerializer->deserialize($requestContent, $class);

        $validationErrors = $this->objectValidator->getValidationErrors($entity);
        if (count($validationErrors) > 0) {
            throw new InvalidRequestDataException($validationErrors);
        }

        return $entity;
    }
}
