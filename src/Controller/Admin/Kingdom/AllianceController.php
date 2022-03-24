<?php

namespace App\Controller\Admin\Kingdom;

use App\Domain\Alliance\Enum\AllianceTypes;
use App\Entity\Alliance\Alliance;
use App\Repository\User\UserRepositoryInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Core\Security;

class AllianceController extends AbstractCrudController
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
        return Alliance::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideWhenCreating()->hideWhenUpdating(),
            TextField::new('name'),
            TextField::new('tag'),
            AssociationField::new('kingdom'),
            AssociationField::new('leader'),
            ChoiceField::new('type')->setChoices(AllianceTypes::toArray()),
        ];
    }
}
