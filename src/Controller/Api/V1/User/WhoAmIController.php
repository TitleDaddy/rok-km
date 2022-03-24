<?php

namespace App\Controller\Api\V1\User;

use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\User\Query\Query\FindUserByIdQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/user/whoami', name: 'api_v1_user_whoami', methods: ['GET'])]
class WhoAmIController extends AbstractApiV1Controller
{
    public function __invoke(): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->queryBus->handle(new FindUserByIdQuery($this->getUser()->getUserIdentifier()));

        return $this->respond($this->serializer->serialize($user));
    }
}
