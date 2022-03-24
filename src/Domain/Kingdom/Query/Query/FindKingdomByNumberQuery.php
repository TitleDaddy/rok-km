<?php

namespace App\Domain\Kingdom\Query\Query;

use App\Common\CQRS\QueryInterface;

class FindKingdomByNumberQuery implements QueryInterface
{
    private int $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function getNumber(): int
    {
        return $this->number;
    }
}
