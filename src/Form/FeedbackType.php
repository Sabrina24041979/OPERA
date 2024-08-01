<?php

namespace App\Form;

use App\Entity\Feedback;
use App\Entity\Interview;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FeedbackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('feedback_text', TextareaType::class, [
                'label' => 'Texte du feedback',
                'attr' => ['placeholder' => 'Entrez votre feedback ici']
            ])
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date du feedback'
            ])
            ->add('type', TextType::class, [
                'label' => 'Type de feedback'
            ])
            ->add('interview', EntityType::class, [
                'class' => Interview::class,
                'choice_label' => 'id',
                'label' => 'Entretien associé'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Feedback::class,
        ]);
    }
}
