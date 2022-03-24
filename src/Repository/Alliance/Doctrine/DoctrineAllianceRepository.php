<?php

namespace App\Repository\Alliance\Doctrine;

use App\Entity\Alliance\Alliance;
use App\Repository\Alliance\AllianceRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class DoctrineAllianceRepository implements AllianceRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Alliance::class);
    }

    public function findByKingdom(string $kingdomId): array
    {
        return $this->repository->findBy([
            'kingdom' => $kingdomId,
        ]);
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function save(Alliance $alliance): void
    {
        $this->entityManager->persist($alliance);
        $this->entityManager->flush();
    }

    public function findById(?string $allianceId): ?Alliance
    {
        return $this->repository->find($allianceId);
    }
}
