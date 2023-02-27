<?php

namespace App\Service;

use App\Dto\Outgoing\HoleDto;
use App\Dto\Outgoing\HoleSimResponseDto;
use App\Dto\Outgoing\Transformer\HoleSimResponseDtoTransformer;
use App\Entity\Hole;
use App\Repository\HoleRepository;

class HoleService extends AbstractMultiTransformer
{
    private HoleSimResponseDtoTransformer $holeResponseDtoTransformer;
    private HoleRepository $holeRepository;

    public function __construct(HoleSimResponseDtoTransformer $holeResponseDtoTransformer, HoleRepository $holeRepository)
    {
        $this->holeResponseDtoTransformer = $holeResponseDtoTransformer;
        $this->holeRepository = $holeRepository;
    }

    public function getAllSimHoles(int $id): iterable{
        $allHoles = $this->getAllHolesByCourseId($id);
        return $this->convertHoleToHoleSim($allHoles);
    }

    public function getAllHolesByCourseId(int $id): iterable
    {
        return $this->holeRepository->findBy(array('course' => $id));
    }

    public function getAllHolesByCourseIdDto(int $id): iterable
    {
        $allHoles = $this->holeRepository->findBy(array('course' => $id));
        return $this->transformFromObjects($allHoles);
    }

    public function convertHoleToHoleSim(iterable $holes): iterable
    {
       return $this->holeResponseDtoTransformer->transformFromObjects($holes);
    }

    /**
     * @param Hole $object
     * @return HoleDto
     */
    public function transformFromObject($object): HoleDto
    {
        $dto = new HoleDto();
        $dto->setHoleId($object->getHoleId());
        $dto->setCourseId($object->getCourse()->getCourseId());
        $dto->setPar($object->getPar());
        $dto->setParkedRate($object->getParkedRate());
        $dto->setC1Rate($object->getC1Rate());
        $dto->setC2Rate($object->getC2Rate());
        $dto->setScrambleRate($object->getScrambleRate());

        return $dto;
    }


}