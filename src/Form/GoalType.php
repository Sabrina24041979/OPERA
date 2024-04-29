<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Goal;
use App\Entity\Personal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class GoalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', TextareaType::class, [
                'attr' => ['placeholder' => 'Décrire l\'objectif'],
                'help' => 'Entrez une description claire de l\'objectif.'
            ])
            ->add('deadline', DateType::class, [
                'widget' => 'single_text',
                'help' => 'Date à laquelle l\'objectif doit être atteint.'
            ])
            ->add('status')
            ->add('priority')
            ->add('createdAt', DateType::class, [
                'widget' => 'single_text',
                'help' => 'Date de création de l\'objectif.'
            ])
            ->add('updatedAt', DateType::class, [
                'widget' => 'single_text',
                'help' => 'Date de la dernière mise à jour de l\'objectif.'
            ])
            ->add('personal', EntityType::class, [
                'class' => Personal::class,
                'choice_label' => 'name',
                'help' => 'Sélectionnez la personne responsable.'
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'help' => 'Sélectionnez la catégorie de l\'objectif.'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Goal::class,
        ]);
    }
}

