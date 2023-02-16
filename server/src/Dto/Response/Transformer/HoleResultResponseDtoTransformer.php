<?php

namespace App\Dto\Response\Transformer;

use App\Dto\Response\HoleResultDto;
use App\Entity\HoleResult;

class HoleResultResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    /**
     * @param HoleResult $object
     * @return HoleResultDto
     */
    public function transformFromObject($object): HoleResultDto
    {
        $dto = new HoleResultDto();
        $dto->score = $object->getScore();
        $dto->c1_putts = $object->getC1Putts();
        $dto->c2_putts = $object->getC2Putts();
        $dto->parked = $object->isParked();
        $dto->c1_in_regulation = $object->isC1InRegulation();
        $dto->c2_in_regulation = $object->isC2InRegulation();
        $dto->scramble = $object->isScramble();
        $dto->luck = $object->getLuck();
        return $dto;
    }

}