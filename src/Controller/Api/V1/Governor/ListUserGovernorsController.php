<?php

namespace App\Controller\Api\V1\Governor;

use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\Governor\Query\Query\GetUserGovernorsQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/user/governor', name: 'api_v1_governor_list_mine', methods: ['GET'])]
class ListUserGovernorsController extends AbstractApiV1Controller
{
    public function __invoke(): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $governors = $this->queryBus->handle(new GetUserGovernorsQuery($this->getUser()->getUserIdentifier()));

        return $this->respond($this->serializer->serialize($governors));
    }
}
