<?php

namespace App\Domain\Commander\Query\Query;

use App\Common\CQRS\QueryInterface;

class FindCommanderByNameQuery implements QueryInterface
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
