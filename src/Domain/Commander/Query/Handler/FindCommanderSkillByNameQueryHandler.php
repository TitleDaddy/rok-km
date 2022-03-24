<?php

namespace App\Domain\Commander\Query\Handler;

use App\Common\CQRS\QueryHandlerInterface;
use App\Domain\Commander\Query\Query\FindCommanderSkillByNameQuery;
use App\Repository\Commander\SkillRepositoryInterface;

class FindCommanderSkillByNameQueryHandler implements QueryHandlerInterface
{
    private SkillRepositoryInterface $repository;

    public function __construct(SkillRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindCommanderSkillByNameQuery $query)
    {
        return $this->repository->forCommanderWithName($query->getCommanderId(), $query->getName());
    }
}
