<?php

namespace App\Domain\Kingdom\Query\Handler;

use App\Common\CQRS\QueryHandlerInterface;
use App\Domain\Kingdom\Query\Query\FindKingdomByNumberQuery;
use App\Repository\Kingdom\KingdomRepositoryInterface;

class FindKingdomByNumberQueryHandler implements QueryHandlerInterface
{
    private KingdomRepositoryInterface $kingdomRepository;

    public function __construct(KingdomRepositoryInterface $kingdomRepository)
    {
        $this->kingdomRepository = $kingdomRepository;
    }

    public function __invoke(FindKingdomByNumberQuery $query)
    {
        return $this->kingdomRepository->findOneByNumber($query->getNumber());
    }
}
