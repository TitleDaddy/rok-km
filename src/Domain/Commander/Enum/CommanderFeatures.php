<?php

namespace App\Domain\Commander\Enum;

use App\Common\Enum\ArrayableEnumInterface;
use App\Common\Enum\ArrayableEnumTrait;

enum CommanderFeatures: string implements ArrayableEnumInterface
{
    use ArrayableEnumTrait;

    case INFANTRY = 'Infantry';
    case CAVALRY = 'Cavalry';
    case ARCHER = 'Archer';
    case INTEGRATION = 'Integration';
    case PEACEKEEPING = 'Peacekeeping';
    case SUPPORT = 'Support';
    case CONQUERING = 'Conquering';
    case VERSATILITY = 'Versatility';
    case SKILL = 'Skill';
    case GARRISON = 'Garrison';
    case MOBILITY = 'Mobility';
    case DEFENSE = 'Defense';
    case ATTACK = 'Attack';
    case LEADERSHIP = 'Leadership';
    case GATHERING = 'Gathering';
}
