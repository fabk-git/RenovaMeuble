<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MeubleType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('titre', TextType::class, ['label' => 'Type de meuble'])
        ->add('description', TextareaType::class, [
            'label' => 'Description',
            'attr' => [
                'rows' => 3
            ]
        ])
        ->add('categories', EntityType::class, [
            'label' => 'Catégories',
            'class' => Category::class,
            'choice_label' => 'name',
            'multiple' => true,
            'expanded' => true
        ])
        ->add('prix', MoneyType::class, [
            'label' => 'Prix du meuble'
        ])
        ->add('imageFile', VichImageType::class)
        ->add('save', SubmitType::class, ['label' => 'Enregistrer']);

    }
}