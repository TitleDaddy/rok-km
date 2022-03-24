<?php

namespace App\Domain\User\Query\Handler;

use App\Common\CQRS\QueryHandlerInterface;
use App\Domain\User\Query\Query\FindUserByIdQuery;
use App\Repository\User\UserRepositoryInterface;

class FindUserByIdQueryHandler implements QueryHandlerInterface
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindUserByIdQuery $query)
    {
        return $this->repository->findOneById($query->getId());
    }
}
