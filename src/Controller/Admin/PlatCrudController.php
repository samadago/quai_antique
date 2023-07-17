<?php

namespace App\Controller\Admin;

use App\Entity\Plat;


use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class PlatCrudController extends AbstractCrudController
{
    // it must return a FQCN (fully-qualified class name) of a Doctrine ORM entity
    public static function getEntityFqcn(): string
    {
        return Plat::class;
    }

    // ...
    public function configureFields(string $pageName): iterable
    {
        return [
            'titre',
            'prix',
            AssociationField::new('categorie')->setFormTypeOption('choice_label', 'nom')
        ];
    }
}
