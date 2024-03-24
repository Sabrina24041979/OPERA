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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('email', EmailType::class) // Utilisez l'EmailType pour une validation d'email automatique
            ->add('password', PasswordType::class) // Le PasswordType masque la saisie par défaut
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('updated_at', null, [
                'widget' => 'single_text',
            ])
            ->add('entry_date', null, [
                'widget' => 'single_text',
            ])
            ->add('exit_date', null, [
                'widget' => 'single_text',
            ])
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
            ->add('register', SubmitType::class, ['label' => 'S\'enregistrer']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personal::class, // Je m'assure que cela pointe vers votre entité Personal
        ]);
    }
}
