<?php

namespace App\Domain\User\Query\Handler;

use App\Common\CQRS\QueryHandlerInterface;
use App\Domain\User\Query\Query\FindUserByEmailQuery;
use App\Repository\User\UserRepositoryInterface;

class FindUserByEmailQueryHandler implements QueryHandlerInterface
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindUserByEmailQuery $query)
    {
        return $this->repository->findOneByEmail($query->getEmail());
    }
}
