<?php

namespace App\Dto\Outgoing\Transformer;

use App\Dto\Outgoing\PlayerTournamentResponseDto;
use App\Entity\PlayerTournament;

class PlayerTournamentResponseDtoTransformer extends AbstractResponseDtoTransformer
{

    private RoundResponseDtoTransformer $roundResponseDtoTransformer;

    /**
     * @param RoundResponseDtoTransformer $roundResponseDtoTransformer
     */
    public function __construct(RoundResponseDtoTransformer $roundResponseDtoTransformer)
    {
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
        $dto->rounds = $this->roundResponseDtoTransformer->transformFromObjects($object->getRound());

        return $dto;
    }
}