<?php

namespace App\Controller\Api\V1\Kingdom;

use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\Kingdom\Query\Query\FindKingdomByNumberQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/kingdom/{number}', name: 'api_v1_get_kingdom', methods: ['GET'])]
class GetKingdomController extends AbstractApiV1Controller
{
    public function __invoke(string $number): JsonResponse
    {
        $kingdoms = $this->queryBus->handle(new FindKingdomByNumberQuery($number));

        return $this->respond($this->serializer->serialize($kingdoms));
    }
}
