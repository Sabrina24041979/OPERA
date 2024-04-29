<?php

namespace App\Form;

use App\Entity\EmployeeSentiments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Personal;

class EmployeeSentimentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sentiment_value', ChoiceType::class, [
                'choices' => [
                    'Heureux' => 'happy',
                    'Triste' => 'sad',
                    'En colère' => 'angry',
                    'Neutre' => 'neutral'
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
            ])
            ->add('category', TextType::class, [
                'required' => false,
                'label' => 'Catégorie',
                'attr' => [
                    'placeholder' => 'Catégorie du sentiment (si applicable)'
                ],
                'help' => 'Catégorie pour classifier le sentiment.'
            ])
            ->add('intensity', ChoiceType::class, [
                'choices' => [
                    'Faible' => 'low',
                    'Moyenne' => 'medium',
                    'Forte' => 'high'
                ],
                'label' => 'Intensité',
                'placeholder' => 'Sélectionnez l’intensité du sentiment',
                'help' => 'Indiquez l’intensité du sentiment exprimé.'
            ])
            ->add('personal', EntityType::class, [
                'class' => Personal::class,
                'choice_label' => 'name',
                'label' => 'Personne associée',
                'placeholder' => 'Sélectionnez une personne',
                'help' => 'La personne à qui le sentiment est associé.'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EmployeeSentiments::class,
        ]);
    }
}
