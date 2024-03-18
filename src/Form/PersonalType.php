<?php

namespace App\Form;

use App\Entity\Manager;
use App\Entity\Personal;
use App\Entity\Profile;
use App\Entity\TeamMember;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('password')
            ->add('created_at')
            ->add('updated_at')
            ->add('entry_date')
            ->add('exit_date')
            ->add('matricule')
            ->add('role')
            ->add('manager_id')
            ->add('department')
            ->add('teamMembers', EntityType::class, [
                'class' => TeamMember::class,
'choice_label' => 'id',
'multiple' => true,
            ])
            ->add('profile', EntityType::class, [
                'class' => Profile::class,
'choice_label' => 'id',
            ])
            ->add('manager', EntityType::class, [
                'class' => Manager::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personal::class,
        ]);
    }
}
