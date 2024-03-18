<?php

namespace App\Form;

use App\Entity\Personal;
use App\Entity\Team;
use App\Entity\TeamMember;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamMemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('role_in_team')
            ->add('joined_at')
            ->add('status')
            ->add('Name')
            ->add('description')
            ->add('personal', EntityType::class, [
                'class' => Personal::class,
'choice_label' => 'id',
'multiple' => true,
            ])
            ->add('team', EntityType::class, [
                'class' => Team::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TeamMember::class,
        ]);
    }
}
