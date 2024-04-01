<?php

namespace App\Form;

use App\Entity\BlocsCompetences;
use App\Entity\Competences;
use App\Entity\Diplomes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlocsCompetencesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idComp', TextType::class, ['label' => 'Identifiant '])
            ->add('nomBlocComp', TextType::class, ['label' => 'Nom du bloc'])
            ->add('descriptionBlocComp', TextType::class, ['label' => 'Description du bloc '])
            ->add('diplomes', EntityType::class, [
                'class' => Diplomes::class,
                'choice_label' => 'nomDip', 
            ])
            ->add('save', SubmitType::class, ['label' => 'enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BlocsCompetences::class,
        ]);
    }
}
