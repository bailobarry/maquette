<?php

namespace App\Form;

use App\Entity\Connaissances;
use App\Entity\Ues;
use App\Entity\BlocsConnaissances;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConnaissancesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ectsConn', NumberType::class, ['label' => 'Ects du connaissance '])
            ->add('descriptionConn', TextType::class, ['label' => 'Description du connaissance '])
            ->add('blocConnaissances', EntityType::class, [
                'class' => BlocsConnaissances::class,
                'choice_label' => 'nomBlocConn',
                'label' => 'Blocs de connaissances',
            ])
            ->add('ues', EntityType::class, [
                'class' => Ues::class,
                'choice_label' => 'titre',
                'label' => 'Selectionner une UE',
            ])
            ->add('save' , SubmitType::class, ['label' => 'enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Connaissances::class,
        ]);
    }
}
