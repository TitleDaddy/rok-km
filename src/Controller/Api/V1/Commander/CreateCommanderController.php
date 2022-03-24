<?php

namespace App\Controller\Api\V1\Commander;

use App\Common\Http\Server\Exception\InvalidRequestDataException;
use App\Common\Validation\ValidationHelper;
use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\Commander\Command\Command\CreateCommanderCommand;
use App\Domain\Commander\Enum\CommanderFeatures;
use App\Domain\Commander\Enum\CommanderObtainableFrom;
use App\Domain\Commander\Enum\CommanderRarity;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;

#[Route('/api/v1/commander', name: 'api_v1_create_commander', methods: ['POST'])]
class CreateCommanderController extends AbstractApiV1Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $command = $this->validate($request, $this->getValidationConstraints());
        $this->commandBus->dispatch($command);

        return $this->respond(null, Response::HTTP_CREATED);
    }

    protected function validate(Request $request, Assert\Collection $constraints): CreateCommanderCommand
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $data = $this->getRequestData($request);
        $errors = ValidationHelper::validateObject($data, $constraints);
        if ($errors) {
            throw new InvalidRequestDataException($errors[0]);
        }

        return new CreateCommanderCommand(
            name: $data['name'],
            features: $data['features'],
            rarity: CommanderRarity::from($data['rarity']),
            obtainableFrom: CommanderObtainableFrom::from($data['obtained_from']),
            kingdomAge: intval($data['kingdom_age'])
        );
    }

    private function getValidationConstraints(): Assert\Collection
    {
        return new Assert\Collection([
            'name' => new Assert\Length([
                'min' => 1,
                'max' => 255,
            ]),
            'features' => [
                new Assert\Count(3),
                new Assert\All(
                    new Assert\Choice(choices: CommanderFeatures::values()),
                ),
            ],
            'rarity' => new Assert\Choice(choices: CommanderRarity::values()),
            'obtained_from' => new Assert\Choice(choices: CommanderObtainableFrom::values()),
            'kingdom_age' => new Assert\GreaterThan(0),
        ]);
    }
}
