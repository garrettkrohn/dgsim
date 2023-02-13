<?php

namespace App\Dto\Response\Transformer;

use App\Dto\Response\HoleResponseDto;
use App\Entity\Hole;

class HoleResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    /**
     * @param Hole $object
     * @return HoleResponseDto
     */
    public function transformFromObject($object): HoleResponseDto
    {
        $dto = new HoleResponseDto();
        $dto->par = $object->getPar();
        $dto->parked = $object->getParkedRate();
        $dto->c1 = $object->getC1Rate();
        $dto->c2 = $object->getC2Rate();
        $dto->scramble = $object->getScrambleRate();
        return $dto;
    }

}