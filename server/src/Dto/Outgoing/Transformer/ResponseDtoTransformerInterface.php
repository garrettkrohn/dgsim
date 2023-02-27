<?php

namespace App\Dto\Outgoing\Transformer;

interface ResponseDtoTransformerInterface
{
    public function transformFromObject($object);
    public function transformFromObjects(iterable $objects): iterable;
}