<?php

namespace App\Dto\Outgoing;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Type;

class FloorCeilingDto
{
    #[NotNull]
    #[Type('array')]
    public array $c1xFloorCeiling;

    #[NotNull]
    #[Type('array')]
    public array $c2FloorCeiling;

    #[NotNull]
    #[Type('array')]
    public array $parkedFloorCeiling;

    #[NotNull]
    #[Type('array')]
    public array $c1RegFloorCeiling;

    #[NotNull]
    #[Type('array')]
    public array $c2RegFloorCeiling;

    #[NotNull]
    #[Type('array')]
    public array $scrambleFloorCeiling;
}