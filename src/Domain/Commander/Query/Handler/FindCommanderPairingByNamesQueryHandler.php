<?php

namespace App\Domain\Commander\Query\Handler;

use App\Common\CQRS\QueryHandlerInterface;
use App\Domain\Commander\Query\Query\FindCommanderPairingByNamesQuery;
use App\Repository\Commander\PairingRepositoryInterface;

class FindCommanderPairingByNamesQueryHandler implements QueryHandlerInterface
{
    private PairingRepositoryInterface $repository;

    public function __construct(PairingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindCommanderPairingByNamesQuery $query)
    {
        return $this->repository->findByPair($query->getPrimaryCommanderId(), $query->getSecondaryCommanderId());
    }
}
