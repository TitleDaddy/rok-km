<?php

namespace App\Domain\Kingdom\Command\Command;

use App\Common\CQRS\CommandInterface;
use App\Domain\Kingdom\Enum\KingdomFocus;
use App\Domain\Kingdom\Enum\KingdomMigrationStatus;
use App\Domain\Kingdom\Enum\KingdomSeed;

class CreateKingdomCommand implements CommandInterface
{
    private int $number;
    private KingdomSeed $seed;
    private bool $councilDriven;
    private KingdomFocus $focus;
    private KingdomMigrationStatus $migrationStatus;
    private string $owningGovernorId;
    private string $userId;

    public function __construct(
        int $number,
        KingdomSeed $seed,
        bool $councilDriven,
        KingdomFocus $focus,
        KingdomMigrationStatus $migrationStatus,
        string $owningGovernorId,
        string $userId,
    ) {
        $this->number = $number;
        $this->seed = $seed;
        $this->councilDriven = $councilDriven;
        $this->focus = $focus;
        $this->migrationStatus = $migrationStatus;
        $this->owningGovernorId = $owningGovernorId;
        $this->userId = $userId;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getSeed(): KingdomSeed
    {
        return $this->seed;
    }

    public function isCouncilDriven(): bool
    {
        return $this->councilDriven;
    }

    public function getFocus(): KingdomFocus
    {
        return $this->focus;
    }

    public function getMigrationStatus(): KingdomMigrationStatus
    {
        return $this->migrationStatus;
    }

    public function getOwningGovernorId(): string
    {
        return $this->owningGovernorId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }
}
