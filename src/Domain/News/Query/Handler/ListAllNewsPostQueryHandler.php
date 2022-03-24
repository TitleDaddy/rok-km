<?php

namespace App\Domain\News\Query\Handler;

use App\Common\CQRS\QueryHandlerInterface;
use App\Domain\News\Query\Query\ListAllNewsPostQuery;
use App\Repository\News\NewsPostRepositoryInterface;

class ListAllNewsPostQueryHandler implements QueryHandlerInterface
{
    private NewsPostRepositoryInterface $repository;

    public function __construct(NewsPostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ListAllNewsPostQuery $query): array
    {
        return $this->repository->findByPaginated(limit: $query->getLimit(), offset: $query->getOffset());
    }
}
