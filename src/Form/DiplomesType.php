<?php

namespace App\Form;

use App\Entity\Diplomes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DiplomesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomDip', TextType::class, ['label'=>'Nom du diplôme'])
            ->add('etablissementDip', TextType::class, ['label'=>'Etablissement'])
            ->add('anneesDip', TextType::class, ['label'=>'Années du diplôme'])
            ->add('nbSemestresDip', NumberType::class, ['label'=>'Nombre de semestres du diplôme'])
            ->add('lmd', TextType::class, ['label'=>'Licence/Master/Doctorat'])
            ->add('save', SubmitType::class, ['label'=>'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Diplomes::class,
        ]);
    }
}
