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
        $dto = new HoleResultDto(
            $object->getScore(),
            $object->getC1Putts(),
            $object->getC2Putts(),
            $object->isParked(),
            $object->isC1InRegulation(),
            $object->isC2InRegulation(),
            $object->isScramble(),
            $object->getLuck()
        );
        return $dto;
    }

}