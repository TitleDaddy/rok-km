<?php

namespace App\Domain\User\Command\Handler;

use App\Common\CQRS\CommandHandlerInterface;
use App\Domain\User\Command\Command\SetUserPasswordCommand;
use App\Repository\User\UserRepositoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SetUserPasswordCommandHandler implements CommandHandlerInterface
{
    private UserRepositoryInterface $repository;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserPasswordHasherInterface $passwordHasher
    ) {
        $this->repository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function __invoke(SetUserPasswordCommand $command)
    {
        $user = $this->repository->findOneByEmail($command->getUsername());
        $password = $this->passwordHasher->hashPassword($user, $command->getPassword());
        $user->setPassword($password);
        $this->repository->save($user);
    }
}
