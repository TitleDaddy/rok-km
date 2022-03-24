<?php

namespace App\Common\CQRS\Messenger;

use App\Common\CQRS\CommandHandlerInterface;
use App\Common\CQRS\CommandInterface;
use Psr\Log\LoggerInterface;

class MessengerCommandAuditHandler implements CommandHandlerInterface
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(CommandInterface $event)
    {
        $class = get_class($event);
        $this->logger->debug("Saw Command {$class}");
    }
}
