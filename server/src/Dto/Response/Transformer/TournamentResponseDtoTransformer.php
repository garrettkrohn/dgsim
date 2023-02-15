<?php

namespace App\Dto\Response\Transformer;

use App\Dto\Response\TournamentResponseDto;
use App\Entity\Tournament;

class TournamentResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    private CourseResponseDtoTransformer $transformer;

    public function __construct(CourseResponseDtoTransformer $transformer)
    {
        $this->transformer = $transformer;
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
            $this->transformer->transformFromObject($object->getCourse()),
            $object->getSeason(),
            $object->getPlayerTournament());
        return $dto;
    }

}