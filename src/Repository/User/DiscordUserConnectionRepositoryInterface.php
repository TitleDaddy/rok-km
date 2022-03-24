<?php

namespace App\Repository\User;

use App\Entity\User\DiscordUserConnection;

interface DiscordUserConnectionRepositoryInterface
{
    public function findOneByEmail(string $email): ?DiscordUserConnection;
    public function save(DiscordUserConnection $userConnection);
}
