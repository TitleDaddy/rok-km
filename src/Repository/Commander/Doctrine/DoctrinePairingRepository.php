<?php

namespace App\Repository\Commander\Doctrine;

use App\Entity\Commander\Pairing;
use App\Repository\Commander\PairingRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class DoctrinePairingRepository implements PairingRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Pairing::class);
    }
    public function findAll(): array
    {
        return $this->repository->findBy([], [
            'primaryCommander' => 'ASC',
        ]);
    }

    public function save(Pairing $pairing): void
    {
        $this->entityManager->persist($pairing);
        $this->entityManager->flush();
    }

    public function findByPair(string $primaryCommanderId, string $secondaryCommanderId): ?Pairing
    {
        return $this->repository->findOneBy([
            'primaryCommander' => $primaryCommanderId,
            'secondaryCommander' => $secondaryCommanderId,
        ]);
    }
}
