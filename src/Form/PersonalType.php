<?php

namespace App\Form;

use App\Entity\Manager;
use App\Entity\Personal;
use App\Entity\Profile;
use App\Entity\TeamMember;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('created_at', null, ['widget' => 'single_text'])
            ->add('updated_at', null, ['widget' => 'single_text'])
            ->add('entry_date', null, ['widget' => 'single_text'])
            ->add('exit_date', null, ['widget' => 'single_text'])
            ->add('matricule')
            ->add('roles', null, ['expanded' => true, 'multiple' => true])
            ->add('manager_id')
            ->add('department')
            ->add('teamMembers', EntityType::class, [
                'class' => TeamMember::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('profile', EntityType::class, [
                'class' => Profile::class,
                'choice_label' => 'name',
            ])
            ->add('manager', EntityType::class, [
                'class' => Manager::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personal::class,
        ]);
    }
}
