<?php

namespace App\Controller\Api\V1\News;

use App\Common\Http\Server\Exception\InvalidRequestDataException;
use App\Common\Validation\ValidationHelper;
use App\Controller\Api\V1\AbstractApiV1Controller;
use App\Domain\News\Command\Command\CreateNewsPostCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;

#[Route('/api/v1/news', name: 'api_v1_create_news', methods: ['POST'])]
class CreateNewsPostController extends AbstractApiV1Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $command = $this->validate($request, $this->getValidationConstraints());
        $this->commandBus->dispatch($command);

        return $this->respond(null, Response::HTTP_CREATED);
    }

    protected function validate(Request $request, Assert\Collection $constraints): CreateNewsPostCommand
    {
        $user = $this->getUser();
        $data = $this->getRequestData($request);
        $errors = ValidationHelper::validateObject($data, $constraints);
        if ($errors) {
            throw new InvalidRequestDataException($errors[0]);
        }

        return new CreateNewsPostCommand(
            userId: $user->getUserIdentifier(),
            title: $data['title'],
            body: $data['body'],
        );
    }

    private function getValidationConstraints(): Assert\Collection
    {
        return new Assert\Collection([
            'title' => new Assert\Length([
                'min' => 1,
                'max' => 30,
            ]),
            'body' => new Assert\Length([
                'min' => 1,
            ]),
        ]);
    }
}
