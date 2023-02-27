<?php

namespace App\Dto\Request\Transformer;

interface RequestDtoTransformerInterface
{
    public function transformFromObject($object);
    public function transformFromObjects(iterable $objects): iterable;
}