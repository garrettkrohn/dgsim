<?php

namespace App\Service;

use App\Dto\Response\HoleResponseDto;
use App\Dto\Response\Transformer\HoleResponseDtoTransformer;
use App\Entity\Hole;

class HoleService
{
    private HoleResponseDtoTransformer $holeResponseDtoTransformer;

    public function __construct(HoleResponseDtoTransformer $holeResponseDtoTransformer)
    {
        $this->holeResponseDtoTransformer = $holeResponseDtoTransformer;
    }

    public function convertHoleToHoleSim(iterable $holes): iterable
    {
       return $this->holeResponseDtoTransformer->transformFromObjects($holes);
    }
}