<?php

namespace App\Command\Kingdom;

use App\Command\BaseCommand;
use App\Domain\Kingdom\Command\Command\CreateKingdomCommand;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Query\Query\FindUserByEmailQuery;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'kingdom:create',
    description: 'Create a new Kingdom',
)]
class AddNewKingdomCommand extends BaseCommand
{
    protected static $defaultName = 'kingdom:create';
    protected static $defaultDescription = 'Create a new Kingdom';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $this->start($output, 2);

        $email = $this->askQuestion($input, $output, 'What is the user\'s Email Address: ');
        $user = $this->queryBus->handle(new FindUserByEmailQuery($email));
        if (! $user) {
            throw new UserNotFoundException($email);
        }
        $this->step();

        $number = $this->askQuestion($input, $output, 'Enter Kingdom Number: ');
        $this->step();

        $command = new CreateKingdomCommand($number, $user->getId());
        $this->commandBus->dispatch($command);
        $io->writeln('<info>New Kingdom Command Submitted</info>');
        $this->finish();

        return Command::SUCCESS;
    }
}
