<?php

namespace App\Service;

use App\Dto\Outgoing\HoleResultDto;
use App\Entity\HoleResult;
use App\Repository\HoleResultRepository;

class HoleResultService extends AbstractMultiTransformer
{
    private HoleResultRepository $holeResultRepository;

    public function __construct(HoleResultRepository $holeResultRepository)
    {
        $this->holeResultRepository = $holeResultRepository;
    }

    /**
     * @param HoleResult $object
     * @return HoleResultDto
     */
    public function transformFromObject($object): HoleResultDto
    {
        $dto = new HoleResultDto();
        $dto->setScore($object->getScore());
        $dto->setC1Putts($object->getC1Putts());
        $dto->setC2Putts($object->getC2Putts());
        $dto->setParked($object->isParked());
        $dto->setC1InRegulation($object->isC1InRegulation());
        $dto->setC2InRegulation($object->isC2InRegulation());
        $dto->setScramble($object->isScramble());
        $dto->setLuck($object->getLuck());

        return $dto;
    }

}