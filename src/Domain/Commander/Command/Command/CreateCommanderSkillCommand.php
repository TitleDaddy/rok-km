<?php

namespace App\Domain\Commander\Command\Command;

use App\Common\CQRS\CommandInterface;
use App\Domain\Commander\Enum\CommanderSkillType;

class CreateCommanderSkillCommand implements CommandInterface
{
    private int $index;
    private string $name;
    private string $description;
    private array $upgrades;
    private CommanderSkillType $type;
    private string $commanderId;

    public function __construct(
        int $index,
        string $name,
        string $description,
        array $upgrades,
        CommanderSkillType $type,
        string $commanderId,
    ) {
        $this->index = $index;
        $this->name = $name;
        $this->description = $description;
        $this->upgrades = $upgrades;
        $this->type = $type;
        $this->commanderId = $commanderId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIndex(): int
    {
        return $this->index;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUpgrades(): array
    {
        return $this->upgrades;
    }

    public function getType(): CommanderSkillType
    {
        return $this->type;
    }

    public function getCommanderId(): string
    {
        return $this->commanderId;
    }
}
