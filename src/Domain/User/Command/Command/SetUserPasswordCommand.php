<?php

namespace App\Domain\User\Command\Command;

use App\Common\CQRS\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

class SetUserPasswordCommand implements CommandInterface
{
    #[Assert\NotBlank]
    private string $username;

    #[Assert\NotBlank]
    private string $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}
