<?php

namespace App\Domain\Governor\Enum;

use App\Common\Enum\ArrayableEnumInterface;
use App\Common\Enum\ArrayableEnumTrait;

enum GovernorType: string implements ArrayableEnumInterface
{
    use ArrayableEnumTrait;

    case MAIN = 'Main Account';
    case ALT = 'Alt Account';
    case FARM = 'Farm Account';
}
