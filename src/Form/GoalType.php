<?php

namespace App\Form;

use App\Entity\Goal;
use App\Entity\Category;
use App\Entity\Personal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class GoalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', TextType::class, [
                'attr' => ['placeholder' => 'Décrire l\'objectif'],
            ])
            ->add('deadline', DateType::class, [
                'widget' => 'single_text',               
            ])
            ->add('status')
            ->add('priority')
            // ->add('createdAt', DateType::class, [
            //     'widget' => 'single_text',                
            // ])
            // ->add('updatedAt', DateType::class, [
            //     'widget' => 'single_text',
            // ])
            ->add('personal', EntityType::class, [
                'class' => Personal::class,
                'choice_label' => 'username',
                'label' => 'Collaborateur',
                'placeholder' => 'Sélectionnez le collaborateur',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
            ]);
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Goal::class,
        ]);
    }
}

