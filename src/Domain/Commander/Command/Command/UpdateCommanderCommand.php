<?php

namespace App\Domain\Commander\Command\Command;

use App\Common\CQRS\CommandInterface;
use App\Domain\Commander\Enum\CommanderObtainableFrom;
use App\Domain\Commander\Enum\CommanderRarity;

class UpdateCommanderCommand implements CommandInterface
{
    private string $name;
    private array $features;
    private CommanderRarity $rarity;
    private CommanderObtainableFrom $obtainableFrom;
    private int $kingdomAge;

    public function __construct(
        string $name,
        array $features,
        CommanderRarity $rarity,
        CommanderObtainableFrom $obtainableFrom,
        int $kingdomAge
    ) {
        $this->name = $name;
        $this->features = $features;
        $this->rarity = $rarity;
        $this->obtainableFrom = $obtainableFrom;
        $this->kingdomAge = $kingdomAge;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFeatures(): array
    {
        return $this->features;
    }

    public function getRarity(): CommanderRarity
    {
        return $this->rarity;
    }

    public function getObtainableFrom(): CommanderObtainableFrom
    {
        return $this->obtainableFrom;
    }

    public function getKingdomAge(): int
    {
        return $this->kingdomAge;
    }
}
