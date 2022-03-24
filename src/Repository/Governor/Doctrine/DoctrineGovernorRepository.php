<?php

namespace App\Repository\Governor\Doctrine;

use App\Entity\Governor\Governor;
use App\Repository\Governor\GovernorRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class DoctrineGovernorRepository implements GovernorRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Governor::class);
    }

    public function save(Governor $governor): void
    {
        $this->entityManager->persist($governor);
        $this->entityManager->flush();
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findOneById(string $id): ?Governor
    {
        return $this->repository->find($id);
    }

    public function findAllByUserId(string $userId): array
    {
        return $this->repository->findBy([
            'user' => $userId,
        ]);
    }

    public function findOneByGameId(string $gameId): ?Governor
    {
        return $this->repository->findOneBy([
            'gameId' => $gameId,
        ]);
    }
}
