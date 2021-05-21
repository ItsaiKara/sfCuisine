<?php

namespace App\Controller\Admin;

use App\Entity\Recette;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RecetteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recette::class;
    }

    public function configureFields(string $pageName): iterable
    {

        return [
            TextField::new('nom'),
            TextField::new('description'),
            TextAreaField::new('etapes'),
            IntegerField::new('temps'),
            ImageField::new('image')->setBasePath('/images/recette')->hideOnForm(),
            Field::new('imageFile')->setFormType(VichImageType::class)->onlyOnForms(),
            DateField::new('date'),
            TextAreaField::new('ingredients'),
            AssociationField::new('autheur'),
            AssociationField::new('categorie'),
        ];
    }
}
