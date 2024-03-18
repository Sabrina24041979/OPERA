<?php

namespace App\Form;

use App\Entity\EmployeeSentiments;
use App\Entity\Personal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeSentimentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sentiment_value')
            ->add('date')
            ->add('comment')
            ->add('category')
            ->add('intensity')
            ->add('personal', EntityType::class, [
                'class' => Personal::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EmployeeSentiments::class,
        ]);
    }
}
