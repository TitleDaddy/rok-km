<?php

namespace App\Domain\Governor\Query\Query;

use App\Common\CQRS\QueryInterface;

class GetGovernorByIdQuery implements QueryInterface
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
