<?php

namespace App\Repository\User\Doctrine;

use App\Entity\User\User;
use App\Repository\User\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

class DoctrineUserRepository implements PasswordUpgraderInterface, UserRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(User::class);
    }


    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (! $user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function findOneById(string $id): ?User
    {
        return $this->repository->findOneBy([
            'id' => $id,
        ]);
    }

    /**
     * @return User[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findOneByEmail(string $email): ?User
    {
        return $this->repository->findOneBy([
            'email' => $email,
        ]);
    }
}
