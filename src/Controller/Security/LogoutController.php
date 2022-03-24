<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/security/logout', name: 'security_logout')]
class LogoutController extends AbstractController
{
    public function __invoke(): void
    {
        throw new \LogicException('Route should have been caught by guard');
    }
}
