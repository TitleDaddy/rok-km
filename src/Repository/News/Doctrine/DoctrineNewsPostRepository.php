<?php

namespace App\Repository\News\Doctrine;

use App\Entity\News\NewsPost;
use App\Repository\News\NewsPostRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class DoctrineNewsPostRepository implements NewsPostRepositoryInterface
{
    private const ORDER_BY = [
        'createdAt' => 'DESC',
    ];
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(NewsPost::class);
    }
    public function findAll(): array
    {
        return $this->repository->findBy([], self::ORDER_BY);
    }

    public function save(NewsPost $newsPost): void
    {
        $this->entityManager->persist($newsPost);
        $this->entityManager->flush();
    }

    public function findByPaginated(?int $limit, ?int $offset): array
    {
        return $this->repository->findBy([], self::ORDER_BY, $limit, $offset);
    }
}
