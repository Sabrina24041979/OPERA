<?php

namespace App\Form;

use App\Entity\Personal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class PersonalPermissionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // J'ajoute les champs de formulaire correspondant aux permissions que je souhaite gérer
        $builder
            ->add('canEdit', CheckboxType::class, [
                'label' => 'Peut modifier',
                'required' => false,
            ])
            ->add('canView', CheckboxType::class, [
                'label' => 'Peut voir',
                'required' => false,
            ]);
            // Ajoute d'autres champs selon les permissions disponibles dans ton entité Personal
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personal::class,
        ]);
    }
}
