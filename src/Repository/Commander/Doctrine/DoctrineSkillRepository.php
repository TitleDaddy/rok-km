<?php

namespace App\Repository\Commander\Doctrine;

use App\Entity\Commander\Skill;
use App\Repository\Commander\SkillRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class DoctrineSkillRepository implements SkillRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Skill::class);
    }
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function save(Skill $skill): void
    {
        $this->entityManager->persist($skill);
        $this->entityManager->flush();
    }

    public function forCommander(string $commanderId): array
    {
        return $this->repository->findBy([
            'commander' => $commanderId,
        ]);
    }

    public function forCommanderWithName(string $commanderId, string $name): ?Skill
    {
        return $this->repository->findOneBy([
            'commander' => $commanderId,
            'name' => $name,
        ]);
    }
}
