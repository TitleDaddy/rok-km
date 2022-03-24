<?php

namespace App\Controller\Admin\News;

use App\Entity\News\NewsPost;
use App\Repository\User\UserRepositoryInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Security\Core\Security;

class NewsPostController extends AbstractCrudController
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
        return NewsPost::class;
    }

    public function createEntity(string $entityFqcn): NewsPost
    {
        $userId = $this->security->getUser()->getUserIdentifier();
        $author = $this->userRepository->findOneById($userId);
        $newsPost = new NewsPost($author, '', '', '');
        $newsPost->onPrePersist();

        return $newsPost;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
