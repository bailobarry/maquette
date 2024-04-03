<?php

namespace App\Form;

use App\Entity\Diplomes;
use App\Entity\Role;
use App\Entity\Utilisateurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomUser', TextType::class, ['label' => 'Nom utilisateur'])
            ->add('prenomUser', TextType::class, ['label' => 'Prénom utilisateur'])
            ->add('mail', TextType::class, ['label' => 'Mail utilisateur'])
            ->add('password', TextType::class, ['label' => 'Mot de passe utilisateur'])
            ->add('diplomes', EntityType::class, [
                'class' => Diplomes::class,
                'choice_label' => 'nomDip',
            ])
            ->add('role', EntityType::class, [
                'class' => Role::class,
                'choice_label' => 'nomRole',
            ])
            ->add('save', SubmitType::class, ['label' => 'Enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
}
