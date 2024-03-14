<?php

namespace App\Form;

use App\Entity\Competences;
use App\Entity\Ues;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetencesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ectsComp', NumberType::class, ['label' => 'Ects du compétence '])
            ->add('descriptionComp', TextType::class, ['label' => 'Description du compétence '])
            ->add('ues', EntityType::class, [
                'class' => Ues::class,
                'choice_label' => 'id', 
            ])
            ->add('save' , SubmitType::class, ['label' => 'enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Competences::class,
        ]);
    }
}
