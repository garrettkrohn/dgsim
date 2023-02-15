<?php

namespace App\Service;

use App\Dto\Response\HoleSimResponseDto;
use App\Dto\Response\Transformer\HoleSimResponseDtoTransformer;
use App\Entity\Hole;
use App\Repository\HoleRepository;

class HoleService
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

    public function convertHoleToHoleSim(iterable $holes): iterable
    {
       return $this->holeResponseDtoTransformer->transformFromObjects($holes);
    }
}