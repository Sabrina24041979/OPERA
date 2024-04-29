<?php

namespace App\Form;

use App\Entity\Personal;
use App\Entity\Workload;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkloadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('workload_level', TextType::class, ['label' => 'Niveau de charge'])
            ->add('date', DateType::class, ['widget' => 'single_text', 'label' => 'Date'])
            ->add('comment', TextareaType::class, ['label' => 'Commentaire'])
            ->add('description', TextType::class, ['label' => 'Description'])
            ->add('hours', TextType::class, ['label' => 'Heures'])
            ->add('personal', EntityType::class, [
                'class' => Personal::class,
                'choice_label' => 'name',
                'label' => 'Personnel'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Workload::class,
        ]);
    }
}
