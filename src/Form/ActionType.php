<?php

namespace App\Form;

use App\Entity\Goal;
use App\Entity\Action;
use App\Entity\Personal;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;


class ActionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', TextType::class, [
                'label' => 'Action',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le titre de l\'entretien est obligatoire.',
                    ]),
                ],
            ])
            ->add('priority',  TextType::class, [
                'label' => 'Priorité',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le titre de l\'entretien est obligatoire.',
                    ]),
                ],
            ])
            ->add('status')
            // ->add('created_at')
            ->add('due_date')
            ->add('goal', EntityType::class, [
                'class' => Goal::class,
                'choice_label' => 'description',
                'label' => 'Nom',
                'placeholder' => 'Sélectionnez le collaborateur',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Action::class,
        ]);
    }
}
