<?php

namespace App\Domain\Commander\Enum;

use App\Common\Enum\ArrayableEnumInterface;
use App\Common\Enum\ArrayableEnumTrait;

enum CommanderSkillType: string implements ArrayableEnumInterface
{
    use ArrayableEnumTrait;

    case ACTIVE = 'Active';
    case PASSIVE = 'Passive';
    case EXPERTISE = 'Expertise';
}
