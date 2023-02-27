<?php

namespace App\Service;

use App\Dto\Outgoing\Transformer\PlayerTournamentResponseDtoTransformer;
use App\Repository\PlayerRepository;
use App\Repository\PlayerTournamentRepository;

class PlayerTournamentService
{
    private PlayerTournamentRepository $playerTournamentRepository;
    private PlayerTournamentResponseDtoTransformer $playerTournamentResponseDtoTransformer;

    public function __construct(PlayerTournamentRepository $playerTournamentRepository, PlayerTournamentResponseDtoTransformer $playerTournamentResponseDtoTransformer)
    {
        $this->playerTournamentRepository = $playerTournamentRepository;
        $this->playerTournamentResponseDtoTransformer = $playerTournamentResponseDtoTransformer;
    }


    public function getPlayerTournamentsByPlayerId(int $id): iterable
    {
        $playerTournaments = $this->playerTournamentRepository->findBy(array('player' => $id));
        return $this->playerTournamentResponseDtoTransformer->transformFromObjects($playerTournaments);
    }

}