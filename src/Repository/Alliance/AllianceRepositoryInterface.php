<?php

namespace App\Repository\Alliance;

use App\Entity\Alliance\Alliance;

interface AllianceRepositoryInterface
{
    public function findByKingdom(string $kingdomId): array;

    public function findAll(): array;

    public function save(\App\Entity\Alliance\Alliance $alliance): void;

    public function findById(?string $allianceId): ?Alliance;
}
