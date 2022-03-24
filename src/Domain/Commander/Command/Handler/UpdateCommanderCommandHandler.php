<?php

namespace App\Domain\Commander\Command\Handler;

use App\Common\CQRS\CommandHandlerInterface;
use App\Domain\Commander\Command\Command\UpdateCommanderCommand;
use App\Domain\Commander\Exception\CommanderNotFoundException;
use App\Repository\Commander\CommanderRepositoryInterface;

class UpdateCommanderCommandHandler implements CommandHandlerInterface
{
    private CommanderRepositoryInterface $repository;

    public function __construct(CommanderRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UpdateCommanderCommand $command)
    {
        $commander = $this->repository->findOneByName($command->getName());
        if (! $commander) {
            throw new CommanderNotFoundException($command->getName());
        }

        $commander->setName($command->getName())
            ->setFeatures($command->getFeatures())
            ->setRarity($command->getRarity())
            ->setObtainableFrom($command->getObtainableFrom())
            ->setKingdomAge($command->getKingdomAge());

        $this->repository->save($commander);
    }
}
