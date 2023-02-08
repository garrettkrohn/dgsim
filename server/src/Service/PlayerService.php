<?php

namespace App\Service;

use App\Dto\Request\Transformer\PlayerRequestDtoTransformer;
use App\Dto\Response\Transformer\PlayerResponseDtoTransformer;
use App\Repository\ArchetypeRepository;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;

class PlayerService
{
    private PlayerRepository $playerRepository;
    private ArchetypeRepository $archetypeRepository;
    private EntityManagerInterface $entityManager;
    private PlayerResponseDtoTransformer $transformer;
    private PlayerRequestDtoTransformer $PlayerRequestDtoTransformer;

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
    $this->PlayerRequestDtoTransformer = $playerRequestDtoTransformer;
    }

    public function getAllPlayers(): iterable
    {
        $allPlayers = $this->playerRepository->findAll();
        $response = $this->transformer->transformFromObjects($allPlayers);
        return $response;
    }




}