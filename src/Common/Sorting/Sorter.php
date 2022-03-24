<?php

namespace App\Common\Sorting;

use Traversable;

class Sorter
{
    public const PRESERVE_KEYS = true;
    public const DISCARD_KEYS = false;

    public const CASE_SENSITIVE = true;
    public const CASE_INSENSITIVE = false;

    public static function values(array|Traversable $list, bool $preserveKeys = self::DISCARD_KEYS, bool $caseSensitive = self::CASE_SENSITIVE): array
    {
        $list = static::normalizeCollection($list);
        $flags = static::normalizeFlags($caseSensitive);

        if ($preserveKeys) {
            asort($list, $flags);
        } else {
            sort($list, $flags);
        }

        return $list;
    }

    public static function keys(array|Traversable $list, bool $caseSensitive = self::CASE_SENSITIVE): array
    {
        $list = static::normalizeCollection($list);
        $flags = static::normalizeFlags($caseSensitive);

        ksort($list, $flags);

        return $list;
    }

    public static function natural(array|Traversable $list, bool $preserveKeys = self::DISCARD_KEYS, bool $caseSensitive = self::CASE_SENSITIVE): array
    {
        $list = static::normalizeCollection($list);

        if ($caseSensitive) {
            natsort($list);
        } else {
            natcasesort($list);
        }

        if (! $preserveKeys) {
            $list = array_values($list);
        }

        return $list;
    }

    public static function user(array|Traversable $list, callable $comparison, bool $preserveKeys = self::DISCARD_KEYS): array
    {
        $list = static::normalizeCollection($list);

        if ($preserveKeys) {
            uasort($list, $comparison);
        } else {
            usort($list, $comparison);
        }

        return $list;
    }

    public static function userKeys(array|Traversable $list, callable $comparison): array
    {
        $list = static::normalizeCollection($list);
        uksort($list, $comparison);

        return $list;
    }

    public static function by(array|Traversable $list, callable $comparison, bool $preserveKeys = self::DISCARD_KEYS): array
    {
        return static::chain()->asc($comparison)->values($list, $preserveKeys);
    }

    public static function byDescending(array|Traversable $list, callable $comparison, bool $preserveKeys = self::DISCARD_KEYS): array
    {
        return static::chain()->desc($comparison)->values($list, $preserveKeys);
    }

    private static function normalizeCollection(array|Traversable $list): array
    {
        if (is_array($list)) {
            return $list;
        }

        if ($list instanceof Traversable) {
            return iterator_to_array($list);
        }
    }

    private static function normalizeFlags(bool $caseSensitive): int
    {
        $flag = SORT_REGULAR;
        if ($caseSensitive === static::CASE_INSENSITIVE) {
            $flag = SORT_STRING | SORT_FLAG_CASE;
        }

        return $flag;
    }

    public static function chain(): ChainSorter
    {
        return new ChainSorter([]);
    }
}
