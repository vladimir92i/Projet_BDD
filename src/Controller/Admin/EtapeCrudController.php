<?php

namespace App\Controller\Admin;

use App\Entity\Etape;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class EtapeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Etape::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('num_etape'),
            DateField::new('date'),
            TextField::new('type'),
            TextEditorField::new('distance_parcouru'),
            AssociationField::new('ville_depart_id'),
            AssociationField::new('ville_arrive_id'),
            AssociationField::new('vainqueur'),
        ];
    }
}
