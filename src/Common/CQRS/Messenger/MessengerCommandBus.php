<?php

declare(strict_types=1);

namespace App\Common\CQRS\Messenger;

use App\Common\CQRS\CommandBusInterface;
use App\Common\CQRS\CommandInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerCommandBus implements CommandBusInterface
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function dispatch(CommandInterface $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
