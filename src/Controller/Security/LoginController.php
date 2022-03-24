<?php

namespace App\Controller\Security;

use App\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/security/login', name: 'security_login')]
class LoginController extends AbstractController
{
    public function __invoke(Request $request): Response
    {
        return $this->render('security/login.html.twig');
    }
}
