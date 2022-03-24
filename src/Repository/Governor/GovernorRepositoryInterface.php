<?php

namespace App\Repository\Governor;

use App\Entity\Governor\Governor;

interface GovernorRepositoryInterface
{
    public function save(Governor $governor): void;

    /**
     * @return Governor[]
     */
    public function findAll(): array;

    public function findOneById(string $id): ?Governor;

    public function findAllByUserId(string $userId): array;

    public function findOneByGameId(string $gameId): ?Governor;
}
