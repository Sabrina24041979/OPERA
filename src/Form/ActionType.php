<?php

namespace App\Form;

use App\Entity\Action;
use App\Entity\Goal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('priority')
            ->add('status')
            ->add('created_at')
            ->add('updated_at')
            ->add('due_date')
            ->add('name')
            ->add('goal', EntityType::class, [
                'class' => Goal::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Action::class,
        ]);
    }
}
