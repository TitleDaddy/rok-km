<?php

namespace App\Common\Enum;

trait ArrayableEnumTrait
{
    public static function values(): array
    {
        return array_map(fn (\BackedEnum $enum) => $enum->value, self::cases());
    }

    public static function keys(): array
    {
        return array_map(fn (\BackedEnum $enum) => $enum->name, self::cases());
    }
}
