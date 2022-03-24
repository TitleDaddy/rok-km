<?php

namespace App\Domain\Alliance\Enum;

enum AllianceTypes: string
{
    case MAIN = 'Main Alliance';
    case ACADEMY = 'Academy';
    case FARM = 'Farm Alliance';
    case SHELL = 'KvK Shell Alliance';
    case UNSANCTIONED = 'Unsanctioned Alliance';

    public static function values(): array
    {
        return [
            self::MAIN->value,
            self::ACADEMY->value,
            self::FARM->value,
            self::SHELL->value,
            self::UNSANCTIONED->value,
        ];
    }

    public static function toArray(): array
    {
        return [
            self::MAIN->name => self::MAIN->value,
            self::ACADEMY->name => self::ACADEMY->value,
            self::FARM->name => self::FARM->value,
            self::SHELL->name => self::SHELL->value,
            self::UNSANCTIONED->name => self::UNSANCTIONED->value,
        ];
    }
}
