<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
// use Symfony\Component\OptionsResolver\OptionsResolver;
// use Symfony\Component\Validator\Constraints\NotBlank;
// use Symfony\Component\Validator\Constraints\Email;

class PasswordResetRequestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse e-mail',
                'attr' => ['class' => 'form-control']
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer le lien de réinitialisation',
                'attr' => ['class' => 'btn btn-primary']
            ]);
    }
}

//     public function configureOptions(OptionsResolver $resolver)
//     {
//         $resolver->setDefaults([
//             // Activation de la protection CSRF
//             'csrf_protection' => true,
//             'csrf_field_name' => '_token',
//             // Un identifiant unique pour aider à la génération du token CSRF
//             'csrf_token_id'   => 'password_request',
//         ]);
//     }
// }
