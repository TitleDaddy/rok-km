<?php

namespace App\Repository\Commander\Doctrine;

use App\Entity\Commander\Commander;
use App\Repository\Commander\CommanderRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class DoctrineCommanderRepository implements CommanderRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Commander::class);
    }
    public function findAll(): array
    {
        return $this->repository->findBy([], [
            'name' => 'ASC',
        ]);
    }

    public function save(Commander $commander): void
    {
        $this->entityManager->persist($commander);
        $this->entityManager->flush();
    }

    public function findByPaginated(?int $limit, ?int $offset): array
    {
        return $this->repository->findBy([], [
            'name' => 'ASC',
        ], $limit, $offset);
    }

    public function findOneByName(string $name): ?Commander
    {
        return $this->repository->findOneBy([
            'name' => $name,
        ]);
    }

    public function findOneById(string $commanderId): ?Commander
    {
        return $this->repository->find($commanderId);
    }
}
