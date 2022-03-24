<?php

namespace App\Domain\Commander\Command\Handler;

use App\Common\CQRS\CommandHandlerInterface;
use App\Domain\Commander\Command\Command\CreateCommanderPairingCommand;
use App\Domain\Commander\Exception\PairingAlreadyExistsException;
use App\Entity\Commander\Pairing;
use App\Repository\Commander\PairingRepositoryInterface;

class CreateCommanderPairingCommandHandler implements CommandHandlerInterface
{
    private PairingRepositoryInterface $repository;

    public function __construct(PairingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateCommanderPairingCommand $command)
    {
        $primaryCommander = $command->getPrimaryCommander();
        $secondaryCommander = $command->getSecondaryCommander();
        $exists = $this->repository->findByPair($primaryCommander->getName(), $secondaryCommander->getName());
        if ($exists) {
            throw new PairingAlreadyExistsException($primaryCommander->getName(), $secondaryCommander->getName());
        }

        $pairing = new Pairing(
            primaryCommander: $command->getPrimaryCommander(),
            secondaryCommander: $command->getSecondaryCommander(),
        );
        $this->repository->save($pairing);
    }
}
