<?php

namespace App\Service;

use App\Dto\Request\Transformer\PlayerRequestDtoTransformer;
use App\Dto\Response\Transformer\PlayerResponseDtoTransformer;
use App\Repository\ArchetypeRepository;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PlayerService
{
    private PlayerRepository $playerRepository;
    private ArchetypeRepository $archetypeRepository;
    private EntityManagerInterface $entityManager;
    private PlayerResponseDtoTransformer $transformer;
    private PlayerRequestDtoTransformer $playerRequestDtoTransformer;

    public function __construct(PlayerRepository $playerRepository,
                                ArchetypeRepository $archetypeRepository,
                                EntityManagerInterface $entityManager,
                                PlayerResponseDtoTransformer $transformer,
                                PlayerRequestDtoTransformer $playerRequestDtoTransformer)
    {
    $this->playerRepository = $playerRepository;
    $this->archetypeRepository = $archetypeRepository;
    $this->entityManager = $entityManager;
    $this->transformer = $transformer;
    $this->playerRequestDtoTransformer = $playerRequestDtoTransformer;
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
        $newPlayer = $this->playerRequestDtoTransformer->transformObject($request);
        $this->entityManager->persist($newPlayer);
        $this->entityManager->flush();

        $response = new Response();
        return $response->setStatusCode(Response::HTTP_ACCEPTED);
    }

}