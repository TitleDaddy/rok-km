<?php

namespace App\Domain\Commander\Command\Handler;

use App\Common\CQRS\CommandHandlerInterface;
use App\Domain\Commander\Command\Command\CreateCommanderCommand;
use App\Domain\Commander\Exception\CommanderAlreadyExistsException;
use App\Entity\Commander\Commander;
use App\Repository\Commander\CommanderRepositoryInterface;

class CreateCommanderCommandHandler implements CommandHandlerInterface
{
    private CommanderRepositoryInterface $repository;

    public function __construct(CommanderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateCommanderCommand $command)
    {
        $exists = $this->repository->findOneByName($command->getName());
        if ($exists) {
            throw new CommanderAlreadyExistsException($command->getName());
        }

        $commander = new Commander(
            name: $command->getName(),
            features: $command->getFeatures(),
            rarity: $command->getRarity(),
            obtainableFrom: $command->getObtainableFrom(),
            kingdomAge: $command->getKingdomAge(),
        );

        $this->repository->save($commander);
    }
}
