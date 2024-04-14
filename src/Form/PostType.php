<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * Je construis le formulaire pour les posts.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => 'Contenu du post',
                'attr' => ['placeholder' => 'Partagez quelque chose avec votre réseau...'],
                'required' => true,
            ])
            ->add('visibility', ChoiceType::class, [
                'label' => 'Visibilité',
                'choices' => [
                    'Public' => 'public',
                    'Amis uniquement' => 'friends',
                    'Privé' => 'private',
                ],
                'expanded' => true,
                'multiple' => false,
                'required' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Publier',
            ]);
    }

    /**
     * Je configure les options pour ce type de formulaire.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
