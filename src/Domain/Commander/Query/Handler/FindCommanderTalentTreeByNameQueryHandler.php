<?php

namespace App\Domain\Commander\Query\Handler;

use App\Common\CQRS\QueryHandlerInterface;
use App\Domain\Commander\Query\Query\FindCommanderTalentTreeByNameQuery;
use App\Repository\Commander\TalentTreeRepositoryInterface;

class FindCommanderTalentTreeByNameQueryHandler implements QueryHandlerInterface
{
    private TalentTreeRepositoryInterface $repository;

    public function __construct(TalentTreeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindCommanderTalentTreeByNameQuery $query)
    {
        return $this->repository->forCommanderWithName($query->getCommanderId(), $query->getName());
    }
}
