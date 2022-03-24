<?php

namespace App\Controller\Admin\ROK;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GovernorController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return \App\Entity\Governor\Governor::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideWhenCreating()->hideWhenUpdating(),
            TextField::new('name'),
            NumberField::new('power'),
            AssociationField::new('user'),
            AssociationField::new('leadsAlliance'),
            AssociationField::new('officerOfAlliance'),
            AssociationField::new('alliance'),
        ];
    }
}
