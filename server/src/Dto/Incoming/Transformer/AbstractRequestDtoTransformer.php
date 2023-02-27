<?php

namespace App\Dto\Incoming\Transformer;

abstract class AbstractRequestDtoTransformer implements RequestDtoTransformerInterface
{
    public function transformFromObjects(iterable $objects): iterable
    {
        $dto = [];

        foreach ($objects as $object) {
            $dto[] = $this->transformFromObject($object);
        }

        return $dto;
    }
}