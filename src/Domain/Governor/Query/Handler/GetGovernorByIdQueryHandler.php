<?php

namespace App\Domain\Governor\Query\Handler;

use App\Common\CQRS\QueryHandlerInterface;
use App\Domain\Governor\Query\Query\GetGovernorByIdQuery;
use App\Repository\Governor\GovernorRepositoryInterface;

class GetGovernorByIdQueryHandler implements QueryHandlerInterface
{
    private GovernorRepositoryInterface $repository;

    public function __construct(GovernorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GetGovernorByIdQuery $query)
    {
        return $this->repository->findOneById($query->getId());
    }
}
