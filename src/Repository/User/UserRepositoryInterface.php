<?php

namespace App\Repository\User;

use App\Entity\User\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;

    /**
     * @return User[]
     */
    public function findAll(): array;

    public function findOneById(string $id): ?User;

    public function findOneByEmail(string $email): ?User;
}
