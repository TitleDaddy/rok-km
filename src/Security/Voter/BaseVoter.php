<?php

namespace App\Security\Voter;

use App\Common\CQRS\QueryBusInterface;
use App\Domain\User\Query\Query\FindUserByIdQuery;
use App\Domain\User\UserRoles;
use App\Entity\User\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

abstract class BaseVoter extends Voter
{
    public const VIEW = 'view';
    public const EDIT = 'edit';
    public const LIST = 'list';

    private Security $security;
    private QueryBusInterface $queryBus;

    public function __construct(
        Security $security,
        QueryBusInterface $queryBus,
    ) {
        $this->security = $security;
        $this->queryBus = $queryBus;
    }

    protected function isAdmin(): bool
    {
        return $this->security->isGranted(UserRoles::ROLE_ADMIN->value);
    }

    protected function getUser(TokenInterface $token): ?User
    {
        $user = $token->getUser();
        if (! $user instanceof UserInterface) {
            return null;
        }

        return $this->queryBus->handle(new FindUserByIdQuery($user->getUserIdentifier()));
    }
}
