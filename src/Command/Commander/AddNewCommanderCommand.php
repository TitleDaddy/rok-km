<?php

namespace App\Command\Commander;

use App\Command\BaseCommand;
use App\Domain\Commander\Command\Command\CreateCommanderCommand;
use App\Domain\Commander\Enum\CommanderObtainableFrom;
use App\Domain\Commander\Enum\CommanderRarity;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'commander:create',
    description: 'Create a new Commander',
)]
class AddNewCommanderCommand extends BaseCommand
{
    protected static $defaultName = 'commander:create';
    protected static $defaultDescription = 'Create a new Commander';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $this->start($output, 8);

        $name = $this->askQuestion($input, $output, 'Enter Commander Name: ');
        $this->step();

        $features = [];
        while (count($features) < 3) {
            $idx = count($features) + 1;
            $feature = $this->askQuestion($input, $output, "Enter Feature {$idx}: ");
            if (! empty($feature)) {
                $features[] = $feature;
                $this->step();
            }
        }

        $rarity = $this->chooseOption($input, $output, 'Choose Commander Rarity: ', CommanderRarity::values());
        $this->step();
        $obtainableFrom = $this->chooseOption($input, $output, 'Where can this commander be obtained from: ', CommanderObtainableFrom::values());
        $this->step();
        $kingdomAge = $this->askQuestion($input, $output, 'On what day does this commander become available: ');
        $this->step();
        $command = new CreateCommanderCommand(
            $name,
            $features,
            CommanderRarity::from($rarity),
            CommanderObtainableFrom::from($obtainableFrom),
            $kingdomAge,
        );
        $this->commandBus->dispatch($command);
        $this->step();
        $io->writeln('<info>New News Post Command Submitted</info>');
        $this->finish();

        return Command::SUCCESS;
    }
}
