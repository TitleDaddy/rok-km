<?php

namespace App\Domain\Governor\Query\Query;

use App\Common\CQRS\QueryInterface;

class GetUserGovernorsQuery implements QueryInterface
{
    private string $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}
