<?php

namespace App\Command\Security;

use App\Command\BaseCommand;
use App\Domain\User\Command\Command\SetUserPasswordCommand;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Query\Query\FindUserByEmailQuery;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'security:user:change-password',
    description: 'Change a users password',
)]
class SecurityUserChangePasswordCommand extends BaseCommand
{
    protected static $defaultName = 'security:user:change-password';
    protected static $defaultDescription = 'Change a users password';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $this->start($output, 1);

        $email = $this->askQuestion($input, $output, 'What is the user\'s Email Address: ');
        $user = $this->queryBus->handle(new FindUserByEmailQuery($email));
        if (! $user) {
            throw new UserNotFoundException($email);
        }
        $this->step();

        $password = $this->askQuestion($input, $output, 'Enter new password: ', true);
        $command = new SetUserPasswordCommand($email, $password);
        $this->commandBus->dispatch($command);
        $io->writeln('<info>Password Change Command Submitted</info>');
        $this->finish();

        return Command::SUCCESS;
    }
}
