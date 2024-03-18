<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Goal;
use App\Entity\Personal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GoalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('deadline')
            ->add('status')
            ->add('priority')
            ->add('created_at')
            ->add('updated_at')
            ->add('personal', EntityType::class, [
                'class' => Personal::class,
'choice_label' => 'id',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Goal::class,
        ]);
    }
}
