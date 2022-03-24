<?php

namespace App\Controller\Api\V1\Kingdom;

use App\Common\Http\Server\Exception\InvalidRequestDataException;
use App\Common\Validation\ValidationHelper;
use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\Kingdom\Command\Command\CreateKingdomCommand;
use App\Domain\Kingdom\Enum\KingdomFocus;
use App\Domain\Kingdom\Enum\KingdomMigrationStatus;
use App\Domain\Kingdom\Enum\KingdomSeed;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;

#[Route('/api/v1/kingdom', name: 'api_v1_create_kingdom', methods: ['POST'])]
class CreateKingdomController extends AbstractApiV1Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $command = $this->validate($request, $this->getValidationConstraints());
        $this->commandBus->dispatch($command);

        return $this->respond(null, Response::HTTP_CREATED);
    }

    protected function validate(Request $request, Assert\Collection $constraints): CreateKingdomCommand
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $data = $this->getRequestData($request);
        $errors = ValidationHelper::validateObject($data, $constraints);
        if ($errors) {
            throw new InvalidRequestDataException($errors[0]);
        }

        return new CreateKingdomCommand(
            number: $data['number'],
            seed: KingdomSeed::from($data['seed']),
            councilDriven: $data['council_driven'],
            focus: KingdomFocus::from($data['focus']),
            migrationStatus: KingdomMigrationStatus::from($data['migration_status']),
            owningGovernorId: $data['governor_id'],
            userId: $this->getUser()->getUserIdentifier(),
        );
    }

    private function getValidationConstraints(): Assert\Collection
    {
        return new Assert\Collection([
            'number' => new Assert\GreaterThanOrEqual(1001),
            'seed' => new Assert\Choice(choices: KingdomSeed::values()),
            'council_driven' => new Assert\Type(type: 'boolean'),
            'focus' => new Assert\Choice(choices: KingdomFocus::values()),
            'migration_status' => new Assert\Choice(choices: KingdomMigrationStatus::values()),
            'governor_id' => new Assert\GreaterThan(0),
        ]);
    }
}
