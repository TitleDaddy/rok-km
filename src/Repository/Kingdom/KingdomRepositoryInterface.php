<?php

namespace App\Repository\Kingdom;

use App\Entity\Kingdom\Kingdom;

interface KingdomRepositoryInterface
{
    public function findOneByNumber(int $number): ?Kingdom;

    public function findAll(): array;

    public function save(Kingdom $kingdom): void;

    public function findOneById(string $kingdomId): ?Kingdom;
}
