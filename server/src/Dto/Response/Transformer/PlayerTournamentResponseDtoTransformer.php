<?php

namespace App\Dto\Response\Transformer;

use App\Dto\Response\PlayerTournamentResponseDto;
use App\Entity\PlayerTournament;

class PlayerTournamentResponseDtoTransformer extends AbstractResponseDtoTransformer
{

    private PlayerResponseDtoTransformer $playerResponseDtoTransformer;

    public function __construct(PlayerResponseDtoTransformer $playerResponseDtoTransformer)
    {
        $this->playerResponseDtoTransformer = $playerResponseDtoTransformer;
    }

    /**
     * @param PlayerTournament $object
     * @return void
     */
    public function transformFromObject($object)
    {
        $dto = new PlayerTournamentResponseDto();
        $dto->player_tournament_id = $object->getPlayerTournamentId();
        $dto->tour_points = $object->getTourPoints();
        $dto->total_score = $object->getTotalScore();
        $dto->playerResponseDto = $this->playerResponseDtoTransformer->transformFromObject();

    }
}