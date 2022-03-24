<?php

namespace App\Domain\Commander\Query\Handler;

use App\Common\CQRS\QueryHandlerInterface;
use App\Domain\Commander\Query\Query\FindCommanderByNameQuery;
use App\Repository\Commander\CommanderRepositoryInterface;

class FindCommanderByNameQueryHandler implements QueryHandlerInterface
{
    private CommanderRepositoryInterface $repository;

    public function __construct(CommanderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindCommanderByNameQuery $query)
    {
        return $this->repository->findOneByName($query->getName());
    }
}
