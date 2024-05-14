<?php

namespace App\Form;

use App\Entity\PerformanceReview;
use App\Entity\User; // Assurez-vous que cette entité est correctement utilisée
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PerformanceReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => 'Contenu de la revue',
                'attr' => ['class' => 'form-control'],
                'required' => true
            ])
            ->add('reviewDate', DateTimeType::class, [
                'label' => 'Date de la revue',
                'widget' => 'single_text', // Permet de choisir la date et l'heure avec un seul champ
                'attr' => ['class' => 'form-control']
            ])
            ->add('reviewedUser', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email', // Utiliser l'email comme label dans le dropdown
                'label' => 'Utilisateur évalué',
                'attr' => ['class' => 'form-select']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PerformanceReview::class,
        ]);
    }
}
