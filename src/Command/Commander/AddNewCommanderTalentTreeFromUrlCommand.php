<?php

namespace App\Command\Commander;

use App\Command\BaseCommand;
use App\Domain\Commander\Command\Command\CreateCommanderTalentTreeFromUrlCommand;
use App\Domain\Commander\Exception\CommanderNotFoundException;
use App\Domain\Commander\Exception\TalentTreeAlreadyExistsException;
use App\Domain\Commander\Query\Query\FindCommanderByNameQuery;
use App\Domain\Commander\Query\Query\FindCommanderTalentTreeByNameQuery;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'commander:talent-tree:add',
    description: 'Fetch a talent tree from a URL',
)]
class AddNewCommanderTalentTreeFromUrlCommand extends BaseCommand
{
    protected static $defaultName = 'commander:talent-tree:add';
    protected static $defaultDescription = 'Fetch a talent tree from a URL';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->start($output, 3);

        $commanderName = $this->askQuestion($input, $output, 'Enter Commander Name: ');
        $commander = $this->queryBus->handle(new FindCommanderByNameQuery($commanderName));
        if (! $commander) {
            throw new CommanderNotFoundException($commanderName);
        }
        $this->step();

        $name = $this->askQuestion($input, $output, 'Enter Talent Tree Name: ');
        $this->step();

        $talentTree = $this->queryBus->handle(new FindCommanderTalentTreeByNameQuery($commander->getId(), $name));
        if ($talentTree) {
            throw new TalentTreeAlreadyExistsException($name);
        }
        $this->step();

        $url = $this->askQuestion($input, $output, 'Enter Talent Tree URL: ');

        $this->commandBus->dispatch(new CreateCommanderTalentTreeFromUrlCommand(
            name: $name,
            url: $url,
            commanderId: $commander->getId(),
        ));

        $this->finish();

        return Command::SUCCESS;
    }
}
