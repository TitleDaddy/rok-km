<?php

namespace App\DataFixtures;

use App\Common\CQRS\CommandBusInterface;
use App\Common\CQRS\QueryBusInterface;
use App\Domain\Commander\Command\Command\CreateCommanderPairingCommand;
use App\Domain\Commander\Exception\CommanderNotFoundException;
use App\Domain\Commander\Query\Query\FindCommanderByNameQuery;
use App\Domain\Commander\Query\Query\FindCommanderPairingByNamesQuery;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommanderPairFixtures extends JSONDrivenDataFixture implements DependentFixtureInterface
{
    private CommandBusInterface $commandBus;
    private QueryBusInterface $queryBus;

    public function __construct(CommandBusInterface $commandBus, QueryBusInterface $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function load(ObjectManager $manager)
    {
        $files = $this->readAllFixtureFilesForType('commander_pairings');
        foreach ($files as $file) {
            $this->processFixtureFile($file);
        }
    }

    private function processFixtureFile(array $pairings)
    {
        foreach ($pairings as $pairingData) {
            $primaryCommander = $this->queryBus->handle(new FindCommanderByNameQuery($pairingData['primary']));
            if (! $primaryCommander) {
                throw new CommanderNotFoundException($pairingData['primary']);
            }

            $secondaryCommander = $this->queryBus->handle(new FindCommanderByNameQuery($pairingData['secondary']));
            if (! $secondaryCommander) {
                throw new CommanderNotFoundException($pairingData['secondary']);
            }

            $pairing = $this->queryBus->handle(new FindCommanderPairingByNamesQuery(
                primaryCommanderId: $primaryCommander->getId(),
                secondaryCommanderId: $secondaryCommander->getId(),
            ));

            if ($pairing) {
                continue;
            }

            $this->commandBus->dispatch(new CreateCommanderPairingCommand(
                primaryCommander: $primaryCommander,
                secondaryCommander: $secondaryCommander
            ));
        }
    }
    public function getDependencies(): array
    {
        return [
            CommanderFixtures::class,
        ];
    }
}
