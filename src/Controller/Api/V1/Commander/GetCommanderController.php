<?php

namespace App\Controller\Api\V1\Commander;

use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\Commander\Exception\CommanderNotFoundException;
use App\Domain\Commander\Query\Query\FindCommanderByNameQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/commander/{name}', name: 'api_v1_get_commander', methods: ['GET'])]
class GetCommanderController extends AbstractApiV1Controller
{
    public function __invoke(Request $request, string $name): JsonResponse
    {
        $commander = $this->queryBus->handle(new FindCommanderByNameQuery($name));
        if (! $commander) {
            throw new CommanderNotFoundException($name);
        }

        return $this->respond($this->serializer->serialize($commander));
    }
}
