<?php

namespace App\Common\CQRS\InMemory;

use App\Common\CQRS\QueryBusInterface;
use App\Common\CQRS\QueryInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Throwable;

final class InMemoryQueryBus implements QueryBusInterface
{
    use HandleTrait {
        handle as handleQuery;
    }
    private HandleMessageMiddleware $middleware;
    private HandlersLocator $handlersLocator;

    public function __construct(array $handlers = [])
    {
        $this->handlersLocator = new HandlersLocator($handlers);
        $this->middleware = new HandleMessageMiddleware(new HandlersLocator($handlers));
        $this->messageBus = new MessageBus([$this->middleware]);
    }

    public function handle(QueryInterface $query): mixed
    {
        try {
            return $this->handleQuery($query);
        } catch (HandlerFailedException $exception) {
            while ($exception instanceof HandlerFailedException) {
                /** @var Throwable $exception */
                $exception = $exception->getPrevious();
            }

            throw $exception;
        }
    }
}
