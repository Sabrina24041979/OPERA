<?php

namespace App\Form;

use App\Entity\Feedback;
use App\Entity\Interview;
use App\Entity\Personal;
use App\Entity\TypeInterview;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\NotBlank;

class InterviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text', // Pour faciliter la sélection de la date et de l'heure
                'html5' => 'yyyy-MM-dd HH:mm', // Format ISO
                'label' => 'Date de l\'entretien',
                'constraints' => [
                    new NotBlank([
                        'message' => 'La date de l\'entretien est obligatoire.',
                    ]),
                ],
            ])
            // ->add('title', TextType::class, [
            //     'label' => 'Titre de l\'entretien',
            //     'constraints' => [
            //         new NotBlank([
            //             'message' => 'Le titre de l\'entretien est obligatoire.',
            //         ]),
            //     ],
            // ])
            // ->add('description', TextType::class, [
            //     'label' => 'Description',
            //     'required' => false, // Non obligatoire selon les besoins de l'entreprise
            // ])
            // ->add('interviewer', EntityType::class, [
            //     'class' => Personal::class,
            //     'choice_label' => 'name',
            //     'label' => 'Intervieweur',
            //     'placeholder' => 'Sélectionnez l\'intervieweur',
            //     'constraints' => [
            //         new NotBlank([
            //             'message' => 'L\'intervieweur doit être sélectionné.',
            //         ]),
            //     ],
            // ])
            ->add('interviewee', EntityType::class, [
                'class' => Personal::class,
                'choice_label' => 'username',
                'label' => 'Interviewé',
                'placeholder' => 'Sélectionnez l\'interviewé',
                // 'constraints' => [
                //     new NotBlank([
                //         'message' => 'L\'interviewé doit être sélectionné.',
                //     ]),
                // ],
            ])
            ->add('typeInterview', EntityType::class, [
                'class' => TypeInterview::class,
                'choice_label' => 'name',
                'label' => 'Type d\'entretien',
                'placeholder' => 'Sélectionnez le type d\'entretien',
                // 'constraints' => [
                //     new NotBlank([
                //         'message' => 'Le type d\'entretien est obligatoire.',
                //     ]),
                // ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Interview::class,
        ]);
    }
}
