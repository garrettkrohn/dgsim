<?php

namespace App\Service;

use App\Dto\Outgoing\PlayerTournamentResponseDto;
use App\Dto\Outgoing\Transformer\PlayerTournamentResponseDtoTransformer;
use App\Entity\PlayerTournament;
use App\Repository\PlayerRepository;
use App\Repository\PlayerTournamentRepository;

class PlayerTournamentService extends AbstractMultiTransformer
{
    private PlayerTournamentRepository $playerTournamentRepository;
    private PlayerTournamentResponseDtoTransformer $playerTournamentResponseDtoTransformer;
    private PlayerService $playerService;
    private RoundService $roundService;

    /**
     * @param PlayerTournamentRepository $playerTournamentRepository
     * @param PlayerTournamentResponseDtoTransformer $playerTournamentResponseDtoTransformer
     * @param PlayerService $playerService
     * @param RoundService $roundService
     */
    public function __construct(PlayerTournamentRepository $playerTournamentRepository, PlayerTournamentResponseDtoTransformer $playerTournamentResponseDtoTransformer, PlayerService $playerService, RoundService $roundService)
    {
        $this->playerTournamentRepository = $playerTournamentRepository;
        $this->playerTournamentResponseDtoTransformer = $playerTournamentResponseDtoTransformer;
        $this->playerService = $playerService;
        $this->roundService = $roundService;
    }


    public function getPlayerTournamentsByPlayerId(int $id): iterable
    {
        $playerTournaments = $this->playerTournamentRepository->findBy(array('player' => $id));
        return $this->playerTournamentResponseDtoTransformer->transformFromObjects($playerTournaments);
    }

    /**
     * @param PlayerTournament $object
     * @return PlayerTournamentResponseDto
     */
    public function transformFromObject($object): PlayerTournamentResponseDto
    {
        $dto = new PlayerTournamentResponseDto();
        $dto->setPlayerTournamentId($object->getPlayerTournamentId());
        $dto->setTourPoints($object->getTourPoints());
        $dto->setTotalScore($object->getTotalScore());
        $dto->setPlayerResponseDto($this->playerService->getPlayerByIdDto($object->getPlayer()->getPlayerId()));
        //set rounds
        $dto->setRounds($this->roundService->getAllRoundsByPTIdDto($object->getPlayerTournamentId()));

        return $dto;
    }


}