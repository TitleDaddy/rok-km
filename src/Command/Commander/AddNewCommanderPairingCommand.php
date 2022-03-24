<?php

namespace App\Command\Commander;

use App\Command\BaseCommand;
use App\Domain\Commander\Command\Command\CreateCommanderPairingCommand;
use App\Domain\Commander\Exception\CommanderNotFoundException;
use App\Domain\Commander\Exception\PairingAlreadyExistsException;
use App\Domain\Commander\Query\Query\FindCommanderByNameQuery;
use App\Domain\Commander\Query\Query\FindCommanderPairingByNamesQuery;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'commander:pairing:new',
    description: 'Create a new commander pairing',
)]
class AddNewCommanderPairingCommand extends BaseCommand
{
    protected static $defaultName = 'commander:pairing:new';
    protected static $defaultDescription = 'Create a new commander pairing';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->start($output, 3);

        $primary = $this->askQuestion($input, $output, 'Enter Primary Commander Name: ');
        $commanderOne = $this->queryBus->handle(new FindCommanderByNameQuery($primary));
        if (! $commanderOne) {
            throw new CommanderNotFoundException($primary);
        }
        $this->step();

        $secondary = $this->askQuestion($input, $output, 'Enter Secondary Commander Name: ');
        $commanderTwo = $this->queryBus->handle(new FindCommanderByNameQuery($secondary));
        if (! $commanderTwo) {
            throw new CommanderNotFoundException($secondary);
        }
        $this->step();

        $exists = $this->queryBus->handle(new FindCommanderPairingByNamesQuery($commanderOne->getId(), $commanderTwo->getId()));
        if ($exists) {
            throw new PairingAlreadyExistsException($primary, $secondary);
        }
        $this->step();

        $command = new CreateCommanderPairingCommand($commanderOne, $commanderTwo);
        $this->commandBus->dispatch($command);

        return Command::SUCCESS;
    }
}
