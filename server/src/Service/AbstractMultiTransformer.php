<?php

namespace App\Service;

abstract class AbstractMultiTransformer implements ServiceTransformerInterface
{
    public function transformFromObjects(iterable $objects): iterable
    {
        $dto =[];

        foreach ($objects as $object) {
            $dto[] = $this->transformFromObject($object);
        }

        return $dto;
    }
}