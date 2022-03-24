<?php

namespace App\Controller\Api\V1\Governor;

use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\Governor\Enum\GovernorType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/governor/attributes', name: 'api_v1_get_governor_attributes', methods: ['GET'])]
class GetGovernorAttributes extends AbstractApiV1Controller
{
    public function __invoke(): JsonResponse
    {
        return $this->respond($this->serializer->serialize([
            'types' => GovernorType::values(),
        ]));
    }
}
