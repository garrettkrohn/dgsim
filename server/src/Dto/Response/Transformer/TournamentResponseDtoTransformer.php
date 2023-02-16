<?php

namespace App\Dto\Response\Transformer;

use App\Dto\Response\TournamentResponseDto;
use App\Entity\Tournament;

class TournamentResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    private CourseResponseDtoTransformer $courseResponseDtoTransformer;
    private PlayerTournamentResponseDtoTransformer $playerTournamentResponseDtoTransformer;

    public function __construct(CourseResponseDtoTransformer $courseResponseDtoTransformer, PlayerTournamentResponseDtoTransformer $playerTournamentResponseDtoTransformer)
    {
        $this->courseResponseDtoTransformer = $courseResponseDtoTransformer;
        $this->playerTournamentResponseDtoTransformer = $playerTournamentResponseDtoTransformer;
    }

    /**
     * @param Tournament $object
     * @return TournamentResponseDto
     */
    public function transformFromObject($object): TournamentResponseDto
    {
        $dto = new TournamentResponseDto(
            $object->getTournamentId(),
            $object->getName(),
            $this->courseResponseDtoTransformer->transformFromObject($object->getCourse()),
            $object->getSeason(),
            $this->playerTournamentResponseDtoTransformer->transformFromObjects($object->getPlayerTournament()));
        return $dto;
    }

}