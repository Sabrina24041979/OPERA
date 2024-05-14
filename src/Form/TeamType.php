<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\Manager;
use App\Entity\Personal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('teamName')
            ->add('description')
            ->add('createdAt', DateTimeType::class, [
                'widget' => 'single_text', // Pour faciliter la sélection de la date et de l'heure
                'html5' => 'yyyy-MM-dd', // Format ISO
                'label' => 'Date de l\'entretien',
                'constraints' => [
                    new NotBlank([
                        'message' => 'La date de l\'entretien est obligatoire.',
                    ]),
                ],
            ])
            ->add('manager', EntityType::class, [
                'class' => Manager::class,
                'choice_label' => 'fullname',
                'placeholder' => 'Choisissez un manager',
                'required' => false
            ])
            ->add('members', EntityType::class, [
                'class' => Personal::class,
                'choice_label' => 'username',
                'multiple' => true,
                'label' => 'Membres de l\'équiples membres de l\'équipe',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
