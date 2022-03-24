<?php

namespace App\Controller\Api\V1\Kingdom;

use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\Kingdom\Enum\KingdomFocus;
use App\Domain\Kingdom\Enum\KingdomMigrationStatus;
use App\Domain\Kingdom\Enum\KingdomSeed;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/kingdom/attributes', name: 'api_v1_get_kingdom_attributes', methods: ['GET'])]
class GetKingdomAttributes extends AbstractApiV1Controller
{
    public function __invoke(): JsonResponse
    {
        return $this->respond($this->serializer->serialize([
            'focus' => KingdomFocus::values(),
            'migration_status' => KingdomMigrationStatus::values(),
            'seeds' => KingdomSeed::values(),
        ]));
    }
}
