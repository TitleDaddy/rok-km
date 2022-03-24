<?php

namespace App\Controller\Api\V1\Commander;

use App\Common\Http\Server\Exception\InvalidRequestDataException;
use App\Common\Validation\ValidationHelper;
use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\Commander\Command\Command\UpdateCommanderCommand;
use App\Domain\Commander\Enum\CommanderObtainableFrom;
use App\Domain\Commander\Enum\CommanderRarity;
use App\Domain\Commander\Exception\CommanderNotFoundException;
use App\Domain\Commander\Query\Query\FindCommanderByNameQuery;
use App\Security\Voter\BaseVoter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;

#[Route('/api/v1/commander/{name}', name: 'api_v1_update_commander', methods: ['POST'])]
class UpdateCommanderController extends AbstractApiV1Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $command = $this->validate($request, $this->getValidationConstraints());
        $this->commandBus->dispatch($command);

        return $this->respond(null, Response::HTTP_CREATED);
    }

    protected function validate(Request $request, Assert\Collection $constraints): UpdateCommanderCommand
    {
        $data = $this->getRequestData($request);
        $errors = ValidationHelper::validateObject($data, $constraints);
        if ($errors) {
            throw new InvalidRequestDataException($errors[0]);
        }

        $name = $request->attributes->get('name');
        $commander = $this->queryBus->handle(new FindCommanderByNameQuery($name));
        if (! $commander) {
            throw new CommanderNotFoundException($name);
        }
        $this->denyAccessUnlessGranted(BaseVoter::EDIT, $commander);

        return new UpdateCommanderCommand(
            name: $data['name'],
            features: $data['features'],
            rarity: CommanderRarity::tryFrom($data['rarity']),
            obtainableFrom: CommanderObtainableFrom::tryFrom($data['obtained_from']),
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
            'features' => new Assert\Count(3),
            'rarity' => new Assert\Choice(choices: CommanderRarity::values()),
            'obtained_from' => new Assert\Choice(choices: CommanderObtainableFrom::values()),
            'kingdom_age' => new Assert\GreaterThan(0),
        ]);
    }
}
