<?php

namespace App\Controller\Admin;

use App\Entity\Alliance\Alliance;
use App\Entity\Governor\Governor;
use App\Entity\Kingdom\Kingdom;
use App\Entity\News\NewsPost;
use App\Entity\User\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/stimulus_controller.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Rise of Kingdoms Kingdom Manager');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('News', 'fas fa-list', NewsPost::class);
        yield MenuItem::linkToCrud('Kingdoms', 'fas fa-list', Kingdom::class);
        yield MenuItem::linkToCrud('Governors', 'fas fa-list', Governor::class);
        yield MenuItem::linkToCrud('Alliances', 'fas fa-list', Alliance::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        $menu = parent::configureUserMenu($user);
        if ($user instanceof User) {
            $menu->setGravatarEmail($user->getEmail());
        }

        return $menu;
    }
}
