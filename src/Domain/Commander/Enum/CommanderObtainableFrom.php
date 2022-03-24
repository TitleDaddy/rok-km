<?php

namespace App\Domain\Commander\Enum;

use App\Common\Enum\ArrayableEnumInterface;
use App\Common\Enum\ArrayableEnumTrait;

enum CommanderObtainableFrom: string implements ArrayableEnumInterface
{
    use ArrayableEnumTrait;

    case TAVERN = 'Tavern';
    case EXPEDITION = 'Expedition';
    case MIGHTIEST_GOVERNOR = 'Mightiest Governor';
    case WHEEL_OF_FORTUNE = 'Wheel of Fortune';
    case KINGDOM_VS_KINGDOM = 'Kingdom vs Kingdom';
    case STORE = 'Store Bundles';
    case VIP = 'VIP Bundle';
    case CEROLI = 'Ceroli Crisis';
    case SPECIAL = 'Special Event';
}
