<?php

namespace App\Dto\Response\Transformer;

use App\Dto\Response\HoleSimResponseDto;
use App\Entity\Hole;

class HoleSimResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    /**
     * @param Hole $object
     * @return HoleSimResponseDto
     */
    public function transformFromObject($object): HoleSimResponseDto
    {
        $dto = new HoleSimResponseDto();
        $dto->par = $object->getPar();
        $dto->parked = $object->getParkedRate();
        $dto->c1 = $object->getC1Rate();
        $dto->c2 = $object->getC2Rate();
        $dto->scramble = $object->getScrambleRate();
        $dto->course_id = $object->getCourse()->getCourseId();
        return $dto;
    }

}