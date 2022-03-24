<?php

namespace App\Command\News;

use App\Command\BaseCommand;
use App\Domain\News\Command\Command\CreateNewsPostCommand;
use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Query\Query\FindUserByEmailQuery;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'news:create',
    description: 'Create a new News Post',
)]
class AddNewsPostCommand extends BaseCommand
{
    protected static $defaultName = 'news:create';
    protected static $defaultDescription = 'Create a new News Post';

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

        $title = $this->askQuestion($input, $output, 'Enter post Title: ');
        $this->step();

        $body = $this->askQuestion($input, $output, 'Enter post Body: ');
        $this->step();

        $command = new CreateNewsPostCommand($user->getId(), $title, $body);
        $this->commandBus->dispatch($command);
        $io->writeln('<info>New News Post Command Submitted</info>');
        $this->finish();

        return Command::SUCCESS;
    }
}
