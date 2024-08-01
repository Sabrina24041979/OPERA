<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmailCheckType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse e-mail',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre adresse e-mail.',
                    ]),
                    new Email([
                        'message' => 'L\'adresse e-mail fournie n\'est pas valide.',
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Entrez votre adresse e-mail',
                    'class' => 'form-control' // Classe Bootstrap pour la mise en forme
                ],
                'label_attr' => [
                    'class' => 'form-label mt-3' // Classe Bootstrap pour les labels
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Vérifier',
                'attr' => [
                    'class' => 'btn btn-primary mt-3' // Classe Bootstrap pour les boutons
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Vous pouvez définir des options par défaut ici si nécessaire
        ]);
    }
}
