<?php

namespace App\Domain\User\Command\Command;

use App\Common\CQRS\CommandInterface;

class CreateUserCommand implements CommandInterface
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
