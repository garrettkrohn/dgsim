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
    private PlayerService $playerService;
    private RoundService $roundService;

    /**
     * @param PlayerTournamentRepository $playerTournamentRepository
     * @param PlayerService $playerService
     * @param RoundService $roundService
     */
    public function __construct(PlayerTournamentRepository $playerTournamentRepository, PlayerService $playerService, RoundService $roundService)
    {
        $this->playerTournamentRepository = $playerTournamentRepository;
        $this->playerService = $playerService;
        $this->roundService = $roundService;
    }

    public function getPlayerTournamentsByPlayerId(int $id): iterable
    {
        $playerTournaments = $this->playerTournamentRepository->findBy(array('player' => $id));
        return $this->transformFromObjects($playerTournaments);
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
        $dto->setLuckScore($object->getLuckScore());
        $dto->setPlace($object->getPlace());
        $dto->setPlayerResponseDto($this->playerService->getPlayerByIdDto($object->getPlayer()->getPlayerId()));
        $dto->setRounds($this->roundService->getAllRoundsByPTIdDto($object->getPlayerTournamentId()));

        return $dto;
    }


}