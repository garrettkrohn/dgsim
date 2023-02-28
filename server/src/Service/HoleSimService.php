<?php

namespace App\Service;

use App\Dto\Outgoing\HoleSimResponseDto;
use App\Entity\Hole;

class HoleSimService extends AbstractMultiTransformer
{
    /**
     * @param Hole $object
     * @return HoleSimResponseDto
     */
    public function transformFromObject($object): HoleSimResponseDto
    {
        $dto = new HoleSimResponseDto();
        $dto->setCourseId($object->getCourse()->getCourseId());
        $dto->setPar($object->getPar());
        $dto->setParked($object->getParkedRate());
        $dto->setC1($object->getC1Rate());
        $dto->setC2($object->getC2Rate());
        $dto->setScramble($object->getScrambleRate());

        return $dto;
    }

}