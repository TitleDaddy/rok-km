<?php

namespace App\Repository\User\Doctrine;

use App\Entity\User\DiscordUserConnection;
use App\Repository\User\DiscordUserConnectionRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class DoctrineDiscordUserConnectionRepository implements DiscordUserConnectionRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(DiscordUserConnection::class);
    }

    public function findOneByEmail(string $email): ?DiscordUserConnection
    {
        return $this->repository->findOneBy([
            'discordEmail' => $email,
        ]);
    }

    public function save(DiscordUserConnection $userConnection)
    {
        $this->entityManager->persist($userConnection);
        $this->entityManager->flush();
    }
}
