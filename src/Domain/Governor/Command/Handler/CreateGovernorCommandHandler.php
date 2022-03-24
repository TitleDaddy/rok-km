<?php

namespace App\Domain\Governor\Command\Handler;

use App\Common\CQRS\CommandHandlerInterface;
use App\Common\CQRS\QueryBusInterface;
use App\Domain\Governor\Command\Command\CreateGovernorCommand;
use App\Domain\Governor\Exception\GovernorIdAlreadyExistsException;
use App\Domain\Governor\Query\Query\GetGovernorByGameIdQuery;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Query\Query\FindUserByIdQuery;
use App\Entity\Governor\Governor;
use App\Repository\Governor\GovernorRepositoryInterface;

class CreateGovernorCommandHandler implements CommandHandlerInterface
{
    private GovernorRepositoryInterface $repository;
    private QueryBusInterface $queryBus;

    public function __construct(
        GovernorRepositoryInterface $repository,
        QueryBusInterface $queryBus
    ) {
        $this->repository = $repository;
        $this->queryBus = $queryBus;
    }

    public function __invoke(CreateGovernorCommand $command)
    {
        $user = $this->queryBus->handle(new FindUserByIdQuery($command->getUserId()));
        if (! $user) {
            throw new UserNotFoundException($command->getUserId());
        }

        if ($this->queryBus->handle(new GetGovernorByGameIdQuery($command->getGovernorId()))) {
            throw new GovernorIdAlreadyExistsException($command->getGovernorId());
        }

        $governor = new Governor(
            user: $user,
            gameId: $command->getGovernorId(),
            name: $command->getGovernorName(),
            type: $command->getType(),
            power: $command->getPower(),
        );
        $this->repository->save($governor);
    }
}
