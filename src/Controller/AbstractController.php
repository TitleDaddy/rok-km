<?php

namespace App\Controller;

use App\Common\CQRS\CommandBusInterface;
use App\Common\CQRS\EventBusInterface;
use App\Common\CQRS\QueryBusInterface;
use App\Common\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController extends BaseController
{
    private const LIMIT_KEY = 'limit';
    private const OFFSET_KEY = 'offset';

    protected SerializerInterface $serializer;
    protected QueryBusInterface $queryBus;
    protected CommandBusInterface $commandBus;
    protected EventBusInterface $eventBus;

    public function __construct(
        SerializerInterface $serializer,
        QueryBusInterface $queryBus,
        CommandBusInterface $commandBus,
        EventBusInterface $eventBus,
    ) {
        $this->serializer = $serializer;
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
        $this->eventBus = $eventBus;
    }

    protected function isJsonRequest(Request $request): bool
    {
        return $request->getContentType() === 'json';
    }

    protected function getQueryData(Request $request): array
    {
        return $request->query->all();
    }

    protected function getRequestData(Request $request): array
    {
        if ($request->getContentType() === 'json') {
            $data = json_decode($request->getContent(), true);

            return is_array($data) ? $data : [];
        }

        return $request->request->all();
    }

    protected function getLimit(Request $request): ?int
    {
        $data = $this->getQueryData($request);
        if (array_key_exists(self::LIMIT_KEY, $data) && is_numeric($data[self::LIMIT_KEY])) {
            return $data[self::LIMIT_KEY];
        }

        return null;
    }

    protected function getOffset(Request $request): ?int
    {
        $data = $this->getQueryData($request);
        if (array_key_exists(self::OFFSET_KEY, $data) && is_numeric($data[self::OFFSET_KEY])) {
            return $data[self::OFFSET_KEY];
        }

        return null;
    }

    public function respond(?array $data, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return $this->json([
            'data' => $data,
        ], $statusCode);
    }

    public function respondWithErrors(array $errors, int $statusCode = Response::HTTP_BAD_REQUEST): JsonResponse
    {
        return $this->json([
            'errors' => $errors,
        ], $statusCode);
    }
}
