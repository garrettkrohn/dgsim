<?php

namespace App\Dto\Incoming\Transformer;

interface RequestDtoTransformerInterface
{
    public function transformFromObject($object);
    public function transformFromObjects(iterable $objects): iterable;
}