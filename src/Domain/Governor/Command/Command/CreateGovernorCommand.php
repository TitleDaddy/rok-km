<?php

namespace App\Domain\Governor\Command\Command;

use App\Common\CQRS\CommandInterface;
use App\Domain\Governor\Enum\GovernorType;

class CreateGovernorCommand implements CommandInterface
{
    private int $gameId;
    private string $name;
    private string $userId;
    private int $power;
    private GovernorType $type;

    public function __construct(int $gameId, string $name, string $userId, GovernorType $type, int $power = 0)
    {
        $this->gameId = $gameId;
        $this->name = $name;
        $this->userId = $userId;
        $this->power = $power;
        $this->type = $type;
    }

    public function getGovernorId(): int
    {
        return $this->gameId;
    }

    public function getGovernorName(): string
    {
        return $this->name;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getPower(): int
    {
        return $this->power;
    }

    public function getType(): GovernorType
    {
        return $this->type;
    }
}
