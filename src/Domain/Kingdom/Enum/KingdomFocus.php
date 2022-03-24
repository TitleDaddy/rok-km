<?php

namespace App\Domain\Kingdom\Enum;

use App\Common\Enum\ArrayableEnumInterface;
use App\Common\Enum\ArrayableEnumTrait;

enum KingdomFocus: string implements ArrayableEnumInterface
{
    use ArrayableEnumTrait;

    case KVK_HA_FOCUSED = 'KvK (Heroic Anthem) Focused';
    case KVK_STRIFE_FOCUSED = 'KvK (Strife of the eight) Focused';
    case KVK_OTHER_FOCUSED = 'KvK (Other) Focused';
    case OSIRIS_LEAGUE_FOCUSED = 'Osiris League Focused';
    case NON_SPECIALISED = 'Non-Specialised';
}
