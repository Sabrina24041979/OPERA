<?php

namespace App\Form;

use App\Entity\EmployeeSentiments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeSentimentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sentiment_value', ChoiceType::class, [
                'choices' => [
                    'Heureux' => 'happy',
                    'Neutre' => 'neutral',
                    'Triste' => 'sad',

                ],
                'label' => 'Sentiment',
                'placeholder' => 'Sélectionnez un sentiment',
                'help' => 'Choisissez le sentiment principal exprimé.'
            ])
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date du sentiment',
                'placeholder' => 'Sélectionnez une date et heure',
                'help' => 'Date et heure de l’expression du sentiment.'
            ])
            ->add('comment', TextareaType::class, [
                'required' => false,
                'label' => 'Commentaire',
                'attr' => [
                    'placeholder' => 'Ajoutez un commentaire optionnel.',
                    'rows' => 4
                ],
                'help' => 'Commentaire supplémentaire pour détailler le sentiment.'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EmployeeSentiments::class,
        ]);
    }
}
