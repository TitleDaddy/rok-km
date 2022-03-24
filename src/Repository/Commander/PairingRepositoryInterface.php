<?php

namespace App\Repository\Commander;

use App\Entity\Commander\Pairing;

interface PairingRepositoryInterface
{
    public function save(Pairing $pairing): void;
    public function findByPair(string $primaryCommanderId, string $secondaryCommanderId): ?Pairing;
}
