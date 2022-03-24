<?php

namespace App\Common\CQRS;

abstract class PaginatedQuery implements QueryInterface
{
    protected ?int $offset;
    protected ?int $limit;

    public function __construct(?int $limit, ?int $offset)
    {
        $this->limit = $limit;
        $this->offset = $offset;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }
}
