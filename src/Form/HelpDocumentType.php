<?php

namespace App\Form;

use App\Entity\HelpDocument;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class HelpDocumentType extends AbstractType
{
    /**
     * Je construis le formulaire pour les documents d'aide.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Je définis le champ pour le titre du document.
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => ['autofocus' => true],
                'required' => true
            ])
            // Je définis le champ pour le contenu du document.
            ->add('content', TextareaType::class, [
                'label' => 'Contenu',
                'required' => true
            ])
            // Je définis le champ pour la catégorie du document.
            ->add('category', TextType::class, [
                'label' => 'Catégorie',
                'required' => true
            ]);
    }

    /**
     * Je configure les options pour ce type de formulaire.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HelpDocument::class, // Je lie ce formulaire à l'entité HelpDocument.
        ]);
    }
}
