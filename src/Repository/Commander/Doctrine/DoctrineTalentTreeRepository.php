<?php

namespace App\Repository\Commander\Doctrine;

use App\Entity\Commander\TalentTree;
use App\Repository\Commander\TalentTreeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class DoctrineTalentTreeRepository implements TalentTreeRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(TalentTree::class);
    }

    public function save(TalentTree $talentTree): void
    {
        $this->entityManager->persist($talentTree);
        $this->entityManager->flush();
    }

    public function forCommander(string $commanderId): array
    {
        return $this->repository->findBy([
            'commander' => $commanderId,
        ]);
    }

    public function forCommanderWithName(string $commanderId, string $name): ?TalentTree
    {
        return $this->repository->findOneBy([
            'commander' => $commanderId,
            'name' => $name,
        ]);
    }
}
