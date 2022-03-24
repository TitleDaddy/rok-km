<?php

namespace App\Command;

use App\Common\CQRS\CommandBusInterface;
use App\Common\CQRS\QueryBusInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

abstract class BaseCommand extends Command
{
    protected CommandBusInterface $commandBus;
    protected QueryBusInterface $queryBus;
    protected ProgressBar $progressBar;
    protected OutputInterface $output;

    public function __construct(CommandBusInterface $commandBus, QueryBusInterface $queryBus)
    {
        parent::__construct();
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    protected function ask(InputInterface $input, OutputInterface $output, Question $question)
    {
        $helper = $this->getHelper('question');

        return $helper->ask($input, $output, $question);
    }
    protected function askQuestion(InputInterface $input, OutputInterface $output, string $question, bool $isHidden = false): string
    {
        $question = new Question($question);
        if ($isHidden) {
            $question->setHidden(true);
        }

        return $this->ask($input, $output, $question);
    }

    protected function chooseOption(InputInterface $input, OutputInterface $output, string $question, array $choices): string
    {
        $question = new ChoiceQuestion($question, $choices);

        return $this->ask($input, $output, $question);
    }

    protected function start(OutputInterface $output, int $steps): void
    {
        $this->progressBar = new ProgressBar($output, $steps);
        $this->progressBar->start();
        $this->output = $output;
        $this->output->writeln("\n");
    }

    protected function step(): void
    {
        $this->progressBar->advance();
        $this->output->writeln("\n");
    }

    protected function finish(): void
    {
        $this->progressBar->finish();
    }
}
