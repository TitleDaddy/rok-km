<?php

namespace App\Controller\Admin\Kingdom;

use App\Entity\Kingdom\Kingdom;
use App\Repository\User\UserRepositoryInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Security\Core\Security;

class KingdomController extends AbstractCrudController
{
    private Security $security;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        Security $security,
        UserRepositoryInterface $userRepository
    ) {
        $this->security = $security;
        $this->userRepository = $userRepository;
    }

    public static function getEntityFqcn(): string
    {
        return Kingdom::class;
    }

    public function createEntity(string $entityFqcn): Kingdom
    {
        $userId = $this->security->getUser()->getUserIdentifier();
        $author = $this->userRepository->findOneById($userId);
        $newsPost = new Kingdom($author, 0);
        $newsPost->onPrePersist();

        return $newsPost;
    }
}
