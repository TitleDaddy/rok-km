<?php

namespace App\Repository\Commander;

use App\Entity\Commander\Commander;

interface CommanderRepositoryInterface
{
    public function findAll(): array;
    public function save(Commander $commander): void;
    public function findByPaginated(?int $limit, ?int $offset): array;
    public function findOneByName(string $name): ?Commander;
    public function findOneById(string $commanderId): ?Commander;
}
