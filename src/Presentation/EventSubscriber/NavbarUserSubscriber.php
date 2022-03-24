<?php

namespace App\Presentation\EventSubscriber;

use App\Entity\User\User;
use DateTime;
use JetBrains\PhpStorm\ArrayShape;
use KevinPapst\AdminLTEBundle\Event\NavbarUserEvent;
use KevinPapst\AdminLTEBundle\Event\ShowUserEvent;
use KevinPapst\AdminLTEBundle\Event\SidebarUserEvent;
use KevinPapst\AdminLTEBundle\Model\UserModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class NavbarUserSubscriber implements EventSubscriberInterface
{
    protected Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[ArrayShape([
        NavbarUserEvent::class => 'string',
        SidebarUserEvent::class => 'string',
    ])]
    public static function getSubscribedEvents(): array
    {
        return [
            NavbarUserEvent::class => 'onShowUser',
            SidebarUserEvent::class => 'onShowUser',
        ];
    }

    public function onShowUser(ShowUserEvent $event): void
    {
        if ($this->security->getUser() === null) {
            return;
        }

        /** @var User $myUser */
        $myUser = $this->security->getUser();

        $user = new UserModel();
        $user
            ->setId($myUser->getId())
            ->setName($myUser->getUsername())
            ->setUsername($myUser->getUsername())
            ->setIsOnline(true)
            ->setTitle("{$myUser->getEmail()}")
            ->setMemberSince(new DateTime('@'.$myUser->getCreatedAt()->getTimestamp(), $myUser->getCreatedAt()->getTimezone()))
            ->setAvatar(sprintf('https://www.gravatar.com/avatar/%s', md5(mb_strtolower($myUser->getEmail()))));

        $event->setUser($user);
        $event->setShowLogoutLink(true);
        //$event->setShowProfileLink(true);
        $event->setShowProfileLink(false);
        //$event->addLink(new NavBarUserLink('Followers', 'home'));
    }
}
