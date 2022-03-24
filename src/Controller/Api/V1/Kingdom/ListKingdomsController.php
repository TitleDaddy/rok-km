<?php

namespace App\Controller\Api\V1\Kingdom;

use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\Kingdom\Query\Query\ListAllKingdomsQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/kingdom', name: 'api_v1_list_kingdoms', methods: ['GET'])]
class ListKingdomsController extends AbstractApiV1Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $kingdoms = $this->queryBus->handle(new ListAllKingdomsQuery());

        return $this->respond($this->serializer->serialize($kingdoms));
    }
}
