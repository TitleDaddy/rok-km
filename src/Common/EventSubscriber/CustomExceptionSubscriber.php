<?php

namespace App\Common\EventSubscriber;

use App\Common\Exception\AppException;
use App\Common\Http\Server\Response\ErrorResponseHelper;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;

class CustomExceptionSubscriber implements EventSubscriberInterface
{
    public const HANDLED_EXCEPTION_TYPES = [
        HttpExceptionInterface::class,
        AppException::class,
    ];

    #[ArrayShape([
        KernelEvents::EXCEPTION => 'string',
    ])]
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $e = $event->getThrowable();
        if ($e instanceof HandlerFailedException) {
            $e = $e->getPrevious();
        }

        $statusCode = 500;
        $message = $e->getMessage();
        foreach (self::HANDLED_EXCEPTION_TYPES as $type) {
            if ($e instanceof $type) {
                $statusCode = $e->getCode();
                $message = $e->getMessage();
            }
        }

        $response = ErrorResponseHelper::createResponse([[
            'message' => $message,
            'code' => $statusCode,
        ]]);
        $response->setStatusCode($statusCode);
        $event->setResponse($response);
    }
}
