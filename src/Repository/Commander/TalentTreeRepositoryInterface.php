<?php

namespace App\Repository\Commander;

use App\Entity\Commander\TalentTree;

interface TalentTreeRepositoryInterface
{
    public function save(TalentTree $talentTree): void;
    public function forCommander(string $commanderId): array;
    public function forCommanderWithName(string $commanderId, string $name): ?TalentTree;
}
