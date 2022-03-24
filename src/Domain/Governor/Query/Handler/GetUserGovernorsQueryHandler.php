<?php

namespace App\Domain\Governor\Query\Handler;

use App\Common\CQRS\QueryHandlerInterface;
use App\Domain\Governor\Query\Query\GetUserGovernorsQuery;
use App\Repository\Governor\GovernorRepositoryInterface;

class GetUserGovernorsQueryHandler implements QueryHandlerInterface
{
    private GovernorRepositoryInterface $repository;

    public function __construct(GovernorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GetUserGovernorsQuery $query)
    {
        return $this->repository->findAllByUserId($query->getUserId());
    }
}
