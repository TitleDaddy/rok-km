<?php

namespace App\Domain\Commander\Enum;

use App\Common\Enum\ArrayableEnumInterface;
use App\Common\Enum\ArrayableEnumTrait;

enum CommanderRarity: string implements ArrayableEnumInterface
{
    use ArrayableEnumTrait;

    case LEGENDARY = 'Legendary';
    case EPIC = 'Epic';
    case ELITE = 'Elite';
    case ADVANCED = 'Advanced';

    public function skillUpgradeCost(): int
    {
        return match ($this) {
            CommanderRarity::LEGENDARY => 690,
            CommanderRarity::EPIC => 440,
            CommanderRarity::ELITE => 330,
            CommanderRarity::ADVANCED => 240,
        };
    }

    public function xpUpgradeCost(): int
    {
        return match ($this) {
            CommanderRarity::LEGENDARY => 2820000,
            CommanderRarity::EPIC => 2350000,
            CommanderRarity::ELITE => 18880000,
            CommanderRarity::ADVANCED => 1380000,
        };
    }
}
