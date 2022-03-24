<?php

namespace App\Domain\Governor\Query\Handler;

use App\Common\CQRS\QueryHandlerInterface;
use App\Domain\Governor\Query\Query\GetGovernorByGameIdQuery;
use App\Repository\Governor\GovernorRepositoryInterface;

class GetGovernorByGameIdQueryHandler implements QueryHandlerInterface
{
    private GovernorRepositoryInterface $repository;

    public function __construct(GovernorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(GetGovernorByGameIdQuery $query)
    {
        return $this->repository->findOneByGameId($query->getGameId());
    }
}
