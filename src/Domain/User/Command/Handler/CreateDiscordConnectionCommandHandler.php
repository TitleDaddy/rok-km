<?php

namespace App\Domain\User\Command\Handler;

use App\Common\CQRS\CommandInterface;
use App\Common\CQRS\QueryBusInterface;
use App\Domain\User\Command\Command\CreateDiscordConnectionCommand;
use App\Domain\User\Query\Query\FindUserByEmailQuery;
use App\Entity\User\DiscordUserConnection;
use App\Repository\User\DiscordUserConnectionRepositoryInterface;

class CreateDiscordConnectionCommandHandler implements CommandInterface
{
    private QueryBusInterface $queryBus;
    private DiscordUserConnectionRepositoryInterface $repository;

    public function __construct(QueryBusInterface $queryBus, DiscordUserConnectionRepositoryInterface $repository)
    {
        $this->queryBus = $queryBus;
        $this->repository = $repository;
    }

    public function __invoke(CreateDiscordConnectionCommand $command)
    {
        $user = $this->queryBus->handle(new FindUserByEmailQuery($command->getEmail()));

        $connection = new DiscordUserConnection(
            $user,
            $command->getEmail(),
            $command->getUsername(),
            $command->getDiscordId(),
            $command->getDiscordDiscriminator(),
            $command->getAvatarHash()
        );
        $this->repository->save($connection);
    }
}
