<?php

namespace App\Domain\Commander\Command\Command;

use App\Common\CQRS\CommandInterface;

class CreateCommanderTalentTreeFromUrlCommand implements CommandInterface
{
    private string $name;
    private string $url;
    private string $commanderId;

    public function __construct(
        string $name,
        string $url,
        string $commanderId,
    ) {
        $this->name = $name;
        $this->url = $url;
        $this->commanderId = $commanderId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getCommanderId(): string
    {
        return $this->commanderId;
    }
}
