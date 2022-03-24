<?php

namespace App\Repository\Kingdom\Doctrine;

use App\Entity\Kingdom\Kingdom;
use App\Repository\Kingdom\KingdomRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class DoctrineKingdomRepository implements KingdomRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Kingdom::class);
    }

    public function findOneByNumber(int $number): ?Kingdom
    {
        return $this->repository->findOneBy([
            'number' => $number,
        ]);
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function save(Kingdom $kingdom): void
    {
        $this->entityManager->persist($kingdom);
        $this->entityManager->flush();
    }

    public function findOneById(string $kingdomId): ?Kingdom
    {
        return $this->repository->find($kingdomId);
    }
}
