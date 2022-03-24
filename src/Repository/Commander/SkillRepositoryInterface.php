<?php

namespace App\Repository\Commander;

use App\Entity\Commander\Skill;

interface SkillRepositoryInterface
{
    public function findAll(): array;
    public function save(Skill $skill): void;
    public function forCommander(string $commanderId): array;
    public function forCommanderWithName(string $commanderId, string $name): ?Skill;
}
