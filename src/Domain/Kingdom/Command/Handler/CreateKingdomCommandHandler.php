<?php

namespace App\Domain\Kingdom\Command\Handler;

use App\Common\CQRS\CommandHandlerInterface;
use App\Common\CQRS\QueryBusInterface;
use App\Domain\Governor\Exception\GovernorIdNotFoundException;
use App\Domain\Governor\Query\Query\GetGovernorByIdQuery;
use App\Domain\Kingdom\Command\Command\CreateKingdomCommand;
use App\Domain\Kingdom\Exception\KingdomAlreadyExistsException;
use App\Entity\Governor\Governor;
use App\Entity\Kingdom\Kingdom;
use App\Repository\Kingdom\KingdomRepositoryInterface;

class CreateKingdomCommandHandler implements CommandHandlerInterface
{
    private KingdomRepositoryInterface $kingdomRepository;
    private QueryBusInterface $queryBus;

    public function __construct(
        KingdomRepositoryInterface $kingdomRepository,
        QueryBusInterface $queryBus
    ) {
        $this->kingdomRepository = $kingdomRepository;
        $this->queryBus = $queryBus;
    }

    public function __invoke(CreateKingdomCommand $command)
    {
        $exists = $this->kingdomRepository->findOneByNumber($command->getNumber());
        if ($exists) {
            throw new KingdomAlreadyExistsException($command->getNumber());
        }

        /** @var Governor $governor */
        $governor = $this->queryBus->handle(new GetGovernorByIdQuery($command->getOwningGovernorId()));
        if (! $governor) {
            throw new GovernorIdNotFoundException($command->getOwningGovernorId());
        }

        if (! $governor->getUser()->getUserIdentifier() === $command->getUserId()) {
            throw new GovernorIdNotFoundException($command->getOwningGovernorId());
        }

        $kingdom = new Kingdom(
            number: $command->getNumber(),
            seed: $command->getSeed(),
            councilDriven: $command->isCouncilDriven(),
            focus: $command->getFocus(),
            migrationStatus: $command->getMigrationStatus(),
            owner: $governor,
        );
        $this->kingdomRepository->save($kingdom);
    }
}
