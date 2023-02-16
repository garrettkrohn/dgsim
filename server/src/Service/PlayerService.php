<?php

namespace App\Service;

use App\Dto\Request\Transformer\PlayerRequestDtoTransformer;
use App\Dto\Response\PlayerResponseDto;
use App\Dto\Response\Transformer\PlayerResponseDtoTransformer;
use App\Repository\PlayerRepository;
use App\Service\Simulation\PlayerIngester;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PlayerService
{
    private PlayerRepository $playerRepository;
    private EntityManagerInterface $entityManager;
    private PlayerResponseDtoTransformer $transformer;
    private PlayerRequestDtoTransformer $playerRequestDtoTransformer;
    private PlayerIngester $playerIngester;

    public function __construct(PlayerRepository $playerRepository, EntityManagerInterface $entityManager, PlayerResponseDtoTransformer $transformer, PlayerRequestDtoTransformer $playerRequestDtoTransformer, PlayerIngester $playerIngester)
    {
        $this->playerRepository = $playerRepository;
        $this->entityManager = $entityManager;
        $this->transformer = $transformer;
        $this->playerRequestDtoTransformer = $playerRequestDtoTransformer;
        $this->playerIngester = $playerIngester;
    }


    public function getAllPlayers(): iterable
    {
        $allPlayers = $this->playerRepository->findAll();
        return $this->transformer->transformFromObjects($allPlayers);
    }

    public function getAllPlayerNames(): array
    {
        $allPlayers = $this->playerRepository->findAll();
        $playerNamesArray = [];
        foreach ($allPlayers as $player) {
            $playerNamesArray[] = ['name' => $player->getFirstName() . " " . $player->getLastName()];
        }
        return $playerNamesArray;
    }

    public function createNewPlayer(Request $request): Response
    {
        $newPlayer = $this->playerRequestDtoTransformer->transformFromObject($request);
        $this->entityManager->persist($newPlayer);
        $this->entityManager->flush();

        $response = new Response();
        return $response->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function getPlayerById(int $id): PlayerResponseDto
    {
        $player = $this->playerRepository->findOneBy(array('player_id' => $id));
        return $this->transformer->transformFromObject($player);
    }

    public function getAllActivePlayerEntities(): iterable
    {
        return $this->playerRepository->findBy(array('active' => true));
    }

    public function getAllActivePlayers(): iterable
    {
        $allPlayers = $this->playerRepository->findBy(array('active' => true));
        return $this->transformer->transformFromObjects($allPlayers);
    }

    public function getActivePlayerSimObjects(): iterable
    {
        $allActivePlayers = $this->getAllActivePlayers();
        return $this->getPlayerSimObjects($allActivePlayers);
    }

    public function getPlayerSimObjects($allActivePlayers): iterable
    {
        $FLOOR_CEILING = new \stdClass();
        $FLOOR_CEILING->c1xFloorCeiling = [0.55, 0.92];
        $FLOOR_CEILING->c2FloorCeiling = [0.01, 0.39];
        $FLOOR_CEILING->parkedFloorCeiling = [0.01, 0.16];
        $FLOOR_CEILING->c1RegFloorCeiling = [0.16, 0.46];
        $FLOOR_CEILING->c2RegFloorCeiling = [0.29, 0.73];
        $FLOOR_CEILING->scrambleFloorCeiling = [0.14, 0.64];

        $allPlayersConverted = array();

        foreach($allActivePlayers as $player) {
            $allPlayersConverted[] = $this->playerIngester->convertPlayer($player,$FLOOR_CEILING);
        }

        return $allPlayersConverted;
    }
}