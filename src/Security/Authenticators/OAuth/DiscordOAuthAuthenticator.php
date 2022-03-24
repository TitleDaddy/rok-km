<?php

namespace App\Security\Authenticators\OAuth;

use App\Common\CQRS\CommandBusInterface;
use App\Common\CQRS\QueryBusInterface;
use App\Domain\User\Command\Command\CreateDiscordConnectionCommand;
use App\Domain\User\Command\Command\CreateUserCommand;
use App\Domain\User\Query\Query\FindDiscordUserConnectionByEmailQuery;
use App\Domain\User\Query\Query\FindUserByEmailQuery;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use KnpU\OAuth2ClientBundle\Client\OAuth2ClientInterface;
use KnpU\OAuth2ClientBundle\Security\Authenticator\OAuth2Authenticator;
use League\OAuth2\Client\Token\AccessToken;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Wohali\OAuth2\Client\Provider\DiscordResourceOwner;

class DiscordOAuthAuthenticator extends OAuth2Authenticator
{
    private ClientRegistry $clientRegistry;
    private RouterInterface $router;
    private CommandBusInterface $commandBus;
    private QueryBusInterface $queryBus;

    public function __construct(
        ClientRegistry $clientRegistry,
        RouterInterface $router,
        CommandBusInterface $commandBus,
        QueryBusInterface $queryBus,
    ) {
        $this->clientRegistry = $clientRegistry;
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
        $this->router = $router;
    }

    public function supports(Request $request): bool
    {
        return $request->attributes->get('_route') === 'security_oauth_discord_connect_redirect';
    }

    public function getCredentials(Request $request): AccessToken
    {
        return $this->fetchAccessToken($this->getDiscordClient());
    }

    /**
     * @return OAuth2ClientInterface
     */
    private function getDiscordClient(): OAuth2ClientInterface
    {
        return $this->clientRegistry->getClient('discord');
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey): Response
    {
        $targetUrl = $this->router->generate('security_oauth_finalise');

        return new RedirectResponse($targetUrl);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());

        return new Response($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * Called when authentication is needed, but it's not sent.
     *
     * @param Request $request
     * @param AuthenticationException|null $authException
     * @return RedirectResponse
     */
    public function start(Request $request, AuthenticationException $authException = null): RedirectResponse
    {
        return new RedirectResponse(
            $this->router->generate('security_oauth_discord_connect_start'),
            Response::HTTP_TEMPORARY_REDIRECT
        );
    }

    public function authenticate(Request $request): Passport
    {
        $client = $this->getDiscordClient();
        $accessToken = $this->getCredentials($request);

        return new SelfValidatingPassport(
            new UserBadge($accessToken->getToken(), function () use ($client, $accessToken) {
                /** @var DiscordResourceOwner $discordUser */
                $discordUser = $client->fetchUserFromToken($accessToken);

                $userConnection = $this->queryBus->handle(new FindDiscordUserConnectionByEmailQuery($discordUser->getEmail()));
                if ($userConnection) {
                    return $userConnection->getUser();
                }

                $this->commandBus->dispatch(new CreateUserCommand($discordUser->getEmail()));
                $this->commandBus->dispatch(new CreateDiscordConnectionCommand(
                    $discordUser->getEmail(),
                    $discordUser->getUsername(),
                    $discordUser->getId(),
                    $discordUser->getDiscriminator(),
                    $discordUser->getAvatarHash()
                ));

                return $this->queryBus->handle(new FindUserByEmailQuery($discordUser->getEmail()));
            })
        );
    }
}
