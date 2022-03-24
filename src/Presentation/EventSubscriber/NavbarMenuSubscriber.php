<?php

namespace App\Presentation\EventSubscriber;

use JetBrains\PhpStorm\ArrayShape;
use KevinPapst\AdminLTEBundle\Event\BreadcrumbMenuEvent;
use KevinPapst\AdminLTEBundle\Event\SidebarMenuEvent;
use KevinPapst\AdminLTEBundle\Model\MenuItemInterface;
use KevinPapst\AdminLTEBundle\Model\MenuItemModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Security;

class NavbarMenuSubscriber implements EventSubscriberInterface
{
    private AuthorizationCheckerInterface $authorizationChecker;
    private Security $security;

    public function __construct(
        AuthorizationCheckerInterface $authorizationChecker,
        Security $security,
    ) {
        $this->authorizationChecker = $authorizationChecker;
        $this->security = $security;
    }

    #[ArrayShape([
        SidebarMenuEvent::class => 'string',
        BreadcrumbMenuEvent::class => 'string',
    ])]
    public static function getSubscribedEvents(): array
    {
        return [
            SidebarMenuEvent::class => 'onSetupNavbar',
            BreadcrumbMenuEvent::class => 'onSetupNavbar',
        ];
    }

    private function setupUserNavigation(): array
    {
        if (! $this->security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return [
                new MenuItemModel('login', 'Login', 'security_login', [], 'fas fa-sign-out-alt'),
            ];
        }

        return [
            new MenuItemModel('profile', 'Profile', false, [], 'fas fa-user', false),
            new MenuItemModel('my_governors', 'My Governors', 'frontend_list_user_governors', [], 'fas fa-user'),
            new MenuItemModel('logout', 'Logout', 'security_logout', [], 'fas fa-sign-out-alt'),
        ];
    }

    public function onSetupNavbar(SidebarMenuEvent $event): void
    {
        $items = [];
        $items[] = new MenuItemModel('homepage', 'Home', 'index', [], 'fas fa-home');
        $items = array_merge($items, $this->setupUserNavigation());
        $items[] = new MenuItemModel('rok', 'Rise of Kingdoms', false, [], 'fas fa-gamepad');
        $items[] = new MenuItemModel('commanders', 'Commanders', 'frontend_list_commanders', [], 'fas fa-skull-crossbones');
        $items[] = new MenuItemModel('kingdoms', 'Kingdoms', 'frontend_list_kingdoms', [], 'fas fa-globe');

        foreach ($items as $item) {
            $event->addItem($item);
        }
        $request = $event->getRequest();
        if (! $request) {
            return;
        }
        $this->activateByRoute(
            $request->get('_route'),
            $event->getItems()
        );
    }

    /**
     * @param string $route
     * @param MenuItemInterface[] $items
     */
    protected function activateByRoute(string $route, array $items): void
    {
        foreach ($items as $item) {
            if ($item->hasChildren()) {
                $this->activateByRoute($route, $item->getChildren());
            } elseif ($item->getRoute() === $route) {
                $item->setIsActive(true);
            }
        }
    }
}
