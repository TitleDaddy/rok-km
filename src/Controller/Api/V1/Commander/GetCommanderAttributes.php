<?php

namespace App\Controller\Api\V1\Commander;

use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\Commander\Enum\CommanderFeatures;
use App\Domain\Commander\Enum\CommanderObtainableFrom;
use App\Domain\Commander\Enum\CommanderRarity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/commander/attributes', name: 'api_v1_get_commander_attributes', methods: ['GET'])]
class GetCommanderAttributes extends AbstractApiV1Controller
{
    public function __invoke(): JsonResponse
    {
        return $this->respond($this->serializer->serialize([
            'features' => CommanderFeatures::values(),
            'rarity' => CommanderRarity::values(),
            'obtained_from' => CommanderObtainableFrom::values(),
        ]));
    }
}
