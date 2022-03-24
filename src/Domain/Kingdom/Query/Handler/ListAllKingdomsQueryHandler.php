<?php

namespace App\Domain\Kingdom\Query\Handler;

use App\Common\CQRS\QueryHandlerInterface;
use App\Domain\Kingdom\Query\Query\ListAllKingdomsQuery;
use App\Repository\Kingdom\KingdomRepositoryInterface;

class ListAllKingdomsQueryHandler implements QueryHandlerInterface
{
    private KingdomRepositoryInterface $kingdomRepository;

    public function __construct(KingdomRepositoryInterface $kingdomRepository)
    {
        $this->kingdomRepository = $kingdomRepository;
    }

    public function __invoke(ListAllKingdomsQuery $query)
    {
        return $this->kingdomRepository->findAll();
    }
}
