<?php

declare(strict_types=1);

namespace App\Common\CQRS\Messenger;

use App\Common\CQRS\EventBusInterface;
use App\Common\CQRS\EventInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerEventBus implements EventBusInterface
{
    private MessageBusInterface $eventBus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function dispatch(EventInterface $event): void
    {
        $this->eventBus->dispatch($event);
    }
}
