<?php

namespace App\Dto\Response\Transformer;

use App\Dto\Response\PlayerTournamentResponseDto;
use App\Entity\PlayerTournament;

class PlayerTournamentResponseDtoTransformer extends AbstractResponseDtoTransformer
{

    private PlayerResponseDtoTransformer $playerResponseDtoTransformer;
    private RoundResponseDtoTransformer $roundResponseDtoTransformer;

    public function __construct(PlayerResponseDtoTransformer $playerResponseDtoTransformer, RoundResponseDtoTransformer $roundResponseDtoTransformer)
    {
        $this->playerResponseDtoTransformer = $playerResponseDtoTransformer;
        $this->roundResponseDtoTransformer = $roundResponseDtoTransformer;
    }

    /**
     * @param PlayerTournament $object
     * @return PlayerTournamentResponseDto
     */
    public function transformFromObject($object): PlayerTournamentResponseDto
    {
        $dto = new PlayerTournamentResponseDto();
        $dto->player_tournament_id = $object->getPlayerTournamentId();
        $dto->tour_points = $object->getTourPoints();
        $dto->total_score = $object->getTotalScore();
        $dto->playerResponseDto = $this->playerResponseDtoTransformer->transformFromObject($object->getPlayer());
        $dto->rounds = $this->roundResponseDtoTransformer->transformFromObjects($object->getRoundId());

        return $dto;
    }
}