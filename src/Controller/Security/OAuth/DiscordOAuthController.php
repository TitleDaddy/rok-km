<?php

namespace App\Controller\Security\OAuth;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/security/oauth/discord')]
class DiscordOAuthController extends AbstractController
{
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout()
    {
        throw new LogicException('Guard should have caught the logout');
    }

    #[Route(path: '/connect', name: 'security_oauth_discord_connect_start')]
    public function connectAction(ClientRegistry $clientRegistry): Response
    {
        return $clientRegistry
            ->getClient('discord')
            ->redirect(['identify', 'email'], []);
    }

    #[Route(path: '/redirect', name: 'security_oauth_discord_connect_redirect')]
    public function connectRedirectAction(): void
    {
        throw new LogicException('Handled by Guard.');
    }
}
