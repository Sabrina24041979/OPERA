<?php

namespace App\Form;

use App\Entity\Personal;
use App\Entity\Workload;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkloadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('workload_level')
            ->add('date')
            ->add('comment')
            ->add('description')
            ->add('hours')
            ->add('personal', EntityType::class, [
                'class' => Personal::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Workload::class,
        ]);
    }
}
