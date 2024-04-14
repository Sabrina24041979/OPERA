<?php

namespace App\Form;

use App\Entity\ResourceLink;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ResourceLinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Je définis les champs du formulaire, qui correspondent aux attributs de l'entité ResourceLink
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => ['placeholder' => 'Entrez le titre de la ressource']
            ])
            ->add('url', UrlType::class, [
                'label' => 'URL',
                'attr' => ['placeholder' => 'Entrez l\'URL de la ressource']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
                'attr' => ['placeholder' => 'Entrez une description pour la ressource']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Je configure les options du formulaire pour qu'il travaille avec l'entité ResourceLink
        $resolver->setDefaults([
            'data_class' => ResourceLink::class,
        ]);
    }
}
