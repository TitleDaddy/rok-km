<?php

namespace App\Domain\Kingdom\Enum;

use App\Common\Enum\ArrayableEnumInterface;
use App\Common\Enum\ArrayableEnumTrait;

enum KingdomSeed: string implements ArrayableEnumInterface
{
    use ArrayableEnumTrait;

    case A = 'A';
    case B = 'B';
    case C = 'C';
    case D = 'D';
}
