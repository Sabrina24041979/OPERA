<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('organization_name', TextType::class, [
                'label' => 'Nom de l\'organisation',
                'help' => 'Le nom de votre organisation tel qu\'il apparaîtra dans OPERA.'
            ])
            ->add('admin_email', EmailType::class, [
                'label' => 'Email de l\'administrateur',
                'help' => 'L\'adresse email de l\'administrateur pour les notifications critiques.'
            ])
            ->add('notification_preference', ChoiceType::class, [
                'label' => 'Préférences de notification',
                'choices' => [
                    'Email' => 'email',
                    'Aucune' => 'none'
                ],
                'help' => 'Méthode préférée pour recevoir les notifications opérationnelles.'
            ])
            ->add('enable_analytics', CheckboxType::class, [
                'label' => 'Activer l\'analytique',
                'required' => false,
                'help' => 'Activez pour permettre le suivi analytique des performances de l\'équipe.'
            ])
            ->add('maintenance_mode', CheckboxType::class, [
                'label' => 'Mode maintenance',
                'required' => false,
                'help' => 'Activez cette option pour mettre l\'application en mode maintenance.'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer les configurations'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            
            'data_class' => null, 
        ]);
    }
}
