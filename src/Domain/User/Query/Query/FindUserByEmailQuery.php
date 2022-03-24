<?php

namespace App\Domain\User\Query\Query;

use App\Common\CQRS\QueryInterface;

class FindUserByEmailQuery implements QueryInterface
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
