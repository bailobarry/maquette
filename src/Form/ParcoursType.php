<?php

namespace App\Form;

use App\Entity\Diplomes;
use App\Entity\Parcours;
use App\Entity\Statut;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParcoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idParc', TextType::class, ['label' => 'Idenfiant du parcours'])
            ->add('nomParc', TextType::class, ['label' => 'Nom du parcours'])
            ->add('anneesParc', TextType::class, ['label' => 'Années du parcours'])
            ->add('diplomes', EntityType::class, [
                'class' => Diplomes::class,
                'choice_label' => 'nomDip',
                'label' => 'Sélectionner un diplôme',
            ])
            ->add('save', SubmitType::class, ['label' => 'enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Parcours::class,
        ]);
    }
}
