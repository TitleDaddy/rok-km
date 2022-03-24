<?php

namespace App\Infrastructure\Messenger;

use App\Common\CQRS\CommandHandlerInterface;
use App\Common\CQRS\CommandInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;

class MessengerCommandNotificationHandler implements CommandHandlerInterface
{
    private NotifierInterface $notifier;

    public function __construct(NotifierInterface $notifier)
    {
        $this->notifier = $notifier;
    }

    public function __invoke(CommandInterface $command)
    {
        $class = get_class($command);
        $this->notifier->send(new Notification("Command Dispatched: {$class}", ['chat/discord']));
    }
}
