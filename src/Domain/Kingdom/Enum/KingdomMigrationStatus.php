<?php

namespace App\Domain\Kingdom\Enum;

use App\Common\Enum\ArrayableEnumInterface;
use App\Common\Enum\ArrayableEnumTrait;

enum KingdomMigrationStatus: string implements ArrayableEnumInterface
{
    use ArrayableEnumTrait;

    case PRIVATE = 'Private Kingdom';
    case SUBKINGDOM = 'Sub-Kingdom';
    case CLOSED = 'Migration Closed';
    case OPEN = 'Migration Open';
}
