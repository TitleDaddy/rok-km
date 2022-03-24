<?php

namespace App\Repository\News;

use App\Entity\News\NewsPost;

interface NewsPostRepositoryInterface
{
    public function findAll(): array;
    public function save(NewsPost $newsPost): void;
    public function findByPaginated(?int $limit, ?int $offset): array;
}
