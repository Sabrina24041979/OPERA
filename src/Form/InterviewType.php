<?php

namespace App\Form;

use App\Entity\Feedback;
use App\Entity\Interview;
use App\Entity\Personal;
use App\Entity\TypeInterview;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InterviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('status')
            ->add('Title')
            ->add('description')
            ->add('feedback', EntityType::class, [
                'class' => Feedback::class,
'choice_label' => 'id',
            ])
            ->add('interviewer', EntityType::class, [
                'class' => Personal::class,
'choice_label' => 'id',
            ])
            ->add('interviewee', EntityType::class, [
                'class' => Personal::class,
'choice_label' => 'id',
            ])
            ->add('typeInterview', EntityType::class, [
                'class' => TypeInterview::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Interview::class,
        ]);
    }
}
