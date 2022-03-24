<?php

namespace App\Common\Enum;

interface ArrayableEnumInterface
{
    public static function values(): array;
    public static function keys(): array;
}
