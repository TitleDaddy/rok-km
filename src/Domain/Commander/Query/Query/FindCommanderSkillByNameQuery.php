<?php

namespace App\Domain\Commander\Query\Query;

use App\Common\CQRS\QueryInterface;

class FindCommanderSkillByNameQuery implements QueryInterface
{
    private string $commanderId;
    private string $name;

    public function __construct(string $commanderId, string $name)
    {
        $this->commanderId = $commanderId;
        $this->name = $name;
    }

    public function getCommanderId(): string
    {
        return $this->commanderId;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
