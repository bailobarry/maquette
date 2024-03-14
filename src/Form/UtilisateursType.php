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
            ->add('nom_user', TextType::class, ['label' => 'Nom de l\'utilisateur'])
            ->add('prenom_user', TextType::class, ['label' => 'Prénom de l\'utilisateur'])
            ->add('mail', TextType::class, ['label' => 'Mail de l\'utilisateur'])
            ->add('password', TextType::class, ['label' => 'Mot de passe de l\'utilisateur'])
            ->add('diplomes', EntityType::class, [
                'class' => Diplomes::class,
                'choice_label' => 'id',
            ])
            ->add('role', EntityType::class, [
                'class' => Role::class,
                'choice_label' => 'id',
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
