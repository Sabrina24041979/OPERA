<?php

namespace App\Form;

use App\Entity\Manager;
use App\Entity\Personal;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('team_id')
            ->add('team_name')
            ->add('description')
            ->add('created_at')
            ->add('member')
            ->add('manager', EntityType::class, [
                'class' => Manager::class,
'choice_label' => 'id',
            ])
            ->add('members', EntityType::class, [
                'class' => Personal::class,
'choice_label' => 'id',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
