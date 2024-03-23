<?php

namespace App\Controller\Admin;

use App\Entity\Coureur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\Date;

class CoureurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Coureur::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('num_dossard'),
            TextField::new('prenom'),
            TextField::new('nom'),
            DateField::new('date_de_naissance'),
            AssociationField::new('code_pays'),
            AssociationField::new('code_equipe'),
        ];
    }
}
