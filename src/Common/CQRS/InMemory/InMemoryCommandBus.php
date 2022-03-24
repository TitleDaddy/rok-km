<?php

namespace App\Common\CQRS\InMemory;

use App\Common\CQRS\CommandBusInterface;
use App\Common\CQRS\CommandInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Throwable;

final class InMemoryCommandBus implements CommandBusInterface
{
    private HandleMessageMiddleware $middleware;
    private MessageBus $bus;

    public function __construct(array $handlers = [])
    {
        $this->middleware = new HandleMessageMiddleware(new HandlersLocator($handlers));
        $this->bus = new MessageBus([$this->middleware]);
    }

    /**
     * @throws Throwable
     */
    public function dispatch(CommandInterface $command): void
    {
        try {
            $this->bus->dispatch($command);
        } catch (HandlerFailedException $exception) {
            while ($exception instanceof HandlerFailedException) {
                /** @var Throwable $exception */
                $exception = $exception->getPrevious();
            }

            throw $exception;
        }
    }
}
