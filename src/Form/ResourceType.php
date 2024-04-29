<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Personal;
use App\Entity\Resource;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Title'])
            ->add('description', TextType::class, ['label' => 'Description'])
            ->add('file_path', TextType::class, ['label' => 'File Path'])
            ->add('created_at', DateTimeType::class, ['widget' => 'single_text', 'label' => 'Created At'])
            ->add('updated_at', DateTimeType::class, ['widget' => 'single_text', 'label' => 'Updated At'])
            ->add('personal', EntityType::class, [
                'class' => Personal::class,
                'choice_label' => 'email', // Assuming email is the identifier for Personal
                'label' => 'Personal'
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name', // Assuming name is the identifier for Category
                'label' => 'Category'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Resource::class,
        ]);
    }
}
