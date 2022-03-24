<?php

namespace App\Controller\Api\V1\News;

use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\News\Query\Query\ListAllNewsPostQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/news', name: 'api_v1_list_news', methods: ['GET'])]
class ListNewsPostController extends AbstractApiV1Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $limit = $this->getLimit($request);
        $offset = $this->getOffset($request);

        $posts = $this->queryBus->handle(new ListAllNewsPostQuery(limit: $limit, offset: $offset));

        return $this->respond($this->serializer->serialize($posts));
    }
}
