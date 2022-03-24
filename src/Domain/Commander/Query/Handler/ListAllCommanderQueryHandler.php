<?php

namespace App\Domain\Commander\Query\Handler;

use App\Common\CQRS\QueryHandlerInterface;
use App\Domain\Commander\Query\Query\ListAllCommanderQuery;
use App\Repository\Commander\CommanderRepositoryInterface;

class ListAllCommanderQueryHandler implements QueryHandlerInterface
{
    private CommanderRepositoryInterface $repository;

    public function __construct(CommanderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ListAllCommanderQuery $query)
    {
        return $this->repository->findByPaginated(limit: $query->getLimit(), offset: $query->getOffset());
    }
}
