<?php

namespace App\Form;

use App\Entity\MCCRNE;
use App\Entity\Statut;
use App\Entity\Ues;
use App\Entity\Parcours;
use App\Entity\Utilisateurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;

class UesType extends AbstractType
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    private function getParcoursChoices(): array
    {
        $parcours = $this->em->getRepository(Parcours::class)->findAll();
        $choices = [];
        foreach ($parcours as $parcours) {
            $choices[] = $parcours->getNomParc(); // Assuming getNomParc() returns the name of the parcours
        }
        return $choices;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference', TextType::class, ['label' => 'Reference l\'UE'])
            ->add('semestre', NumberType::class, ['label' => 'Numero de Semestre'])
            ->add('titre', TextType::class, ['label' => 'Titre l\'UE'])
            ->add('ects', NumberType::class, ['label' => 'Ects de l\'UE'])
            ->add('type', TextType::class, ['label' => 'Type l\'UE'])
            ->add('prerequis', TextType::class, ['label' => 'Prérequis l\'UE'])
            ->add('cm', NumberType::class, ['label' => 'Nombre de cm de l\'UE'])
            ->add('td', NumberType::class, ['label' => 'Nombre de td de l\'UE'])
            ->add('tp', NumberType::class, ['label' => 'Nombre de tp de l\'UE'])
            ->add('effectif', NumberType::class, ['label' => 'Effectif de l\'UE'])
            ->add('groupeCM', NumberType::class, ['label' => 'Nombre de groupe de CM'])
            ->add('groupeTD', NumberType::class, ['label' => 'Nombre de groupe TD'])
            ->add('groupeTP', NumberType::class, ['label' => 'Nombre de groupe TP'])
            
            ->add('mcc', EntityType::class, [
                'class' => MCCRNE::class,
                'choice_label' => 'id',
                'label' => 'Modalité de controle',
            ])
            ->add('parcours', ChoiceType::class, [
                'choices' => $this->getParcoursChoices(),
                'choice_label' => function ($choice) {
                  return $choice;
                },
                'label' => 'Parcours de l\'UE',
              ])
            ->add('statut', EntityType::class, [
                'class' => Statut::class,
                'choice_label' => 'statut',
                'label' => 'Statut',
            ])
            ->add('save', SubmitType::class, ['label' => 'enregistrer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ues::class,
        ]);
    }
}
