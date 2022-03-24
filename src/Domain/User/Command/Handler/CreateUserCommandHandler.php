<?php

namespace App\Domain\User\Command\Handler;

use App\Common\CQRS\CommandInterface;
use App\Domain\User\Command\Command\CreateUserCommand;
use App\Entity\User\User;
use App\Repository\User\UserRepositoryInterface;

class CreateUserCommandHandler implements CommandInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(CreateUserCommand $command)
    {
        $user = new User($command->getEmail());
        $this->userRepository->save($user);
    }
}
