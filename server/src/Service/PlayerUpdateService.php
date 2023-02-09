<?php

namespace App\Service;

use App\Dto\Request\Transformer\PlayerRequestDtoTransformer;
use App\Repository\PlayerRepository;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PlayerUpdateService
{
    private PlayerRequestDtoTransformer $playerRequestDtoTransformer;
    private PlayerRepository $playerRepository;

    /**
     * @param PlayerRequestDtoTransformer $playerRequestDtoTransformer
     * @param PlayerRepository $playerRepository
     */
    public function __construct(PlayerRequestDtoTransformer $playerRequestDtoTransformer, PlayerRepository $playerRepository)
    {
        $this->playerRequestDtoTransformer = $playerRequestDtoTransformer;
        $this->playerRepository = $playerRepository;
    }

    #[NoReturn] public function updatePlayer($request): void
    {
        $updatePlayer = $this->playerRequestDtoTransformer->transformFromObject($request);
        $currentPlayer = $this->playerRepository->findOneBy(array('player_id' => $updatePlayer->getPlayerId()));
        //get the current player entity
        //compare then
        //create the player update log
        //persist the player update
    }
}