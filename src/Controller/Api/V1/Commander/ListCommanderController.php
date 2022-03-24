<?php

namespace App\Controller\Api\V1\Commander;

use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\Commander\Query\Query\ListAllCommanderQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/commander', name: 'api_v1_list_commander', methods: ['GET'])]
class ListCommanderController extends AbstractApiV1Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $limit = $this->getLimit($request);
        $offset = $this->getOffset($request);

        $posts = $this->queryBus->handle(new ListAllCommanderQuery(limit: $limit, offset: $offset));

        return $this->respond($this->serializer->serialize($posts));
    }
}
