<?php

namespace App\Form;

use App\Entity\Profile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Je construis mon formulaire de profil avec les champs nécessaires.
        $builder
            ->add('username', TextType::class, [
                'label' => 'Nom d\'utilisateur', // Je définis un label plus clair pour l'utilisateur.
                'attr' => ['placeholder' => 'Entrez votre nom d\'utilisateur'] // Je guide l'utilisateur avec un placeholder.
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom', // Je spécifie le champ pour le prénom de l'utilisateur.
                'attr' => ['placeholder' => 'Entrez votre prénom']
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom', // Je précise que ce champ est pour le nom de famille.
                'attr' => ['placeholder' => 'Entrez votre nom']
            ])
            ->add('position', TextType::class, [
                'label' => 'Position', // Je demande la position de l'utilisateur au sein de l'entreprise.
                'attr' => ['placeholder' => 'Entrez votre position dans l\'entreprise']
            ])
            ->add('birthdate', DateType::class, [
                'label' => 'Date de naissance', // Je collecte la date de naissance avec un widget adapté.
                'widget' => 'single_text', // J'utilise un widget de type texte pour une saisie facile.
                'attr' => ['placeholder' => 'Sélectionnez votre date de naissance']
            ])
            ->add('profilePicture', FileType::class, [
                'label' => 'Photo de profil', // Je permets à l'utilisateur d'uploader une photo de profil.
                'required' => false, // Ce champ n'est pas obligatoire.
                'data_class' => null, // Je m'assure que Symfony gère bien le fichier uploadé comme une entité séparée.
                'attr' => ['placeholder' => 'Téléchargez une photo de profil']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Je configure les options par défaut du formulaire, en particulier la classe de données associée.
        $resolver->setDefaults([
            'data_class' => Profile::class, // Je lie le formulaire à l'entité Profile.
        ]);
    }
}
