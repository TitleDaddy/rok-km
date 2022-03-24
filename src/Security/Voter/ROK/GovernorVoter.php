<?php

namespace App\Security\Voter\ROK;

use App\Entity\Governor\Governor;
use App\Entity\User\User;
use App\Security\Voter\BaseVoter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class GovernorVoter extends BaseVoter
{
    protected function supports(string $attribute, $subject): bool
    {
        return in_array($attribute, [self::EDIT, self::VIEW], true) && $subject instanceof Governor;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $this->getUser($token);
        if (! $user) {
            return false;
        }

        return match ($attribute) {
            self::EDIT => $this->canEdit($subject, $user),
            self::VIEW => $this->canView($subject, $user),
            default => false,
        };
    }

    private function canEdit(Governor $governor, User $user): bool
    {
        return $this->isAdmin() || $governor->getUser()->getUserIdentifier() === $user->getUserIdentifier();
    }

    private function canView(Governor $governor, User $user): bool
    {
        return true;
    }
}
