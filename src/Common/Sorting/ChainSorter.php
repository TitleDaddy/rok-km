<?php

namespace App\Common\Sorting;

use Closure;
use Traversable;

/**
 * Pulled from https://github.com/rosstuck/sort
 */
final class ChainSorter
{
    private array $callables = [];

    public function __construct(array $callables)
    {
        $this->callables = $callables;
    }

    public function compare(callable $callable): self
    {
        return new self(array_merge($this->callables, [$callable]));
    }

    public function asc(callable $callable): self
    {
        return $this->compare($this->singleToComparison($callable));
    }

    public function desc(callable $callable): self
    {
        return $this->compare(
            $this->reverse(
                $this->singleToComparison($callable)
            )
        );
    }

    public function values(array|Traversable $collection, bool $preserveKeys = Sorter::DISCARD_KEYS): array
    {
        return Sorter::user($collection, $this, $preserveKeys);
    }

    public function keys(array|Traversable $collection): array
    {
        return Sorter::userKeys($collection, $this);
    }

    public function __invoke(mixed $a, mixed $b): int
    {
        if (empty($this->callables)) {
            return 0;
        }

        foreach ($this->callables as $callable) {
            $result = $callable($a, $b);

            if ($result !== 0) {
                return $result;
            }
        }

        return 0;
    }

    private function singleToComparison(callable $callable): Closure
    {
        return function ($a, $b) use ($callable) {
            return $callable($a) <=> $callable($b);
        };
    }

    public function reverse(callable $callable): Closure
    {
        return function ($a, $b) use ($callable) {
            return $callable($a, $b) * (-1);
        };
    }
}
