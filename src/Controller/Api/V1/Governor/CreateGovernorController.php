<?php

namespace App\Controller\Api\V1\Governor;

use App\Common\Http\Server\Exception\InvalidRequestDataException;
use App\Common\Validation\ValidationHelper;
use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\Governor\Command\Command\CreateGovernorCommand;
use App\Domain\Governor\Enum\GovernorType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;

#[Route('/api/v1/governor', name: 'api_v1_create_governor', methods: ['POST'])]
class CreateGovernorController extends AbstractApiV1Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $command = $this->validate($request, $this->getValidationConstraints());
        $this->commandBus->dispatch($command);

        return $this->respond(null, Response::HTTP_CREATED);
    }

    protected function validate(Request $request, Assert\Collection $constraints): CreateGovernorCommand
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $data = $this->getRequestData($request);
        $errors = ValidationHelper::validateObject($data, $constraints);
        if ($errors) {
            throw new InvalidRequestDataException($errors[0]);
        }

        return new CreateGovernorCommand(
            gameId: $data['game_id'],
            name: $data['name'],
            userId: $this->getUser()->getUserIdentifier(),
            type: GovernorType::from($data['type']),
            power: $data['power'],
        );
    }

    private function getValidationConstraints(): Assert\Collection
    {
        return new Assert\Collection([
            'game_id' => new Assert\GreaterThan(0),
            'name' => new Assert\Length([
                'min' => 1,
                'max' => 255,
            ]),
            'power' => new Assert\Optional([
                new Assert\GreaterThan(0),
            ]),
            'type' => new Assert\Optional([
                new Assert\Choice(choices: GovernorType::values()),
            ]),
        ]);
    }
}
