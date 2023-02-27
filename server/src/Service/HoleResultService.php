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

    public function buildHoleResult(int $score, int $c1putts, int $c2putts, bool $isParked, bool $c1inReg,
    bool $c2inReg, bool $isScramble, float $luck): HoleResultDto {
        $dto = new HoleResultDto();
        $dto->setScore($score);
        $dto->setC1Putts($c1putts);
        $dto->setC2Putts($c2putts);
        $dto->setParked($isParked);
        $dto->setC1InRegulation($c1inReg);
        $dto->setC2InRegulation($c2inReg);
        $dto->setScramble($isScramble);
        $dto->setLuck($luck);

        return $dto;
    }

}