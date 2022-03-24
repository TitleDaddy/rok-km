<?php

namespace App\Domain\User\Query\Handler;

use App\Common\CQRS\QueryHandlerInterface;
use App\Domain\User\Query\Query\FindDiscordUserConnectionByEmailQuery;
use App\Repository\User\DiscordUserConnectionRepositoryInterface;

class FindDiscordUserByEmailQueryHandler implements QueryHandlerInterface
{
    private DiscordUserConnectionRepositoryInterface $repository;

    public function __construct(DiscordUserConnectionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(FindDiscordUserConnectionByEmailQuery $query)
    {
        return $this->repository->findOneByEmail($query->getEmail());
    }
}
