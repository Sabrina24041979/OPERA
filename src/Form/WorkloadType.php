<?php

namespace App\Form;

use App\Entity\Workload;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class WorkloadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('workload_level', ChoiceType::class, [
                'label' => 'Niveau de charge :',
                'choices' => range(1, 10),
                'choice_label' => function ($choice, $key, $value) {
                    return 'Niveau ' . $value;
                },
                'placeholder' => 'Sélectionner un niveau de charge',
            ])
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date : '
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'Commentaire :'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description :'
            ])
            ->add('hours', NumberType::class, [
                'label' => 'Heures : (nombre entier)',
                'attr' => [
                    'placeholder' => '1, 2, 3, 4....'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Workload::class,
        ]);
    }
}
