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

class InterviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, ['widget' => 'single_text'])
            ->add('status', TextType::class)
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('feedback', EntityType::class, [
                'class' => Feedback::class,
                'choice_label' => 'id',
            ])
            ->add('interviewer', EntityType::class, [
                'class' => Personal::class,
                'choice_label' => 'name',
            ])
            ->add('interviewee', EntityType::class, [
                'class' => Personal::class,
                'choice_label' => 'name',
            ])
            ->add('typeInterview', EntityType::class, [
                'class' => TypeInterview::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Interview::class,
        ]);
    }
}
