<?php

namespace App\Controller\Api\V1\Governor;

use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\Governor\Exception\GovernorIdNotFoundException;
use App\Domain\Governor\Query\Query\GetGovernorByIdQuery;
use App\Security\Voter\BaseVoter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/governor/{id}', name: 'api_v1_get_governor', methods: ['GET'])]
class GetGovernorController extends AbstractApiV1Controller
{
    public function __invoke(string $id): JsonResponse
    {
        $governor = $this->queryBus->handle(new GetGovernorByIdQuery($id));
        if (! $governor) {
            throw new GovernorIdNotFoundException($id);
        }
        $this->denyAccessUnlessGranted(BaseVoter::VIEW, $governor);

        return $this->respond($this->serializer->serialize($governor));
    }
}
