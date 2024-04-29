<?php

namespace App\Form;

use App\Entity\Personal;
use App\Entity\Team;
use App\Entity\TeamMember;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class TeamMemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('roleInTeam', TextType::class)
            ->add('joinedAt', DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('status', TextType::class)
            ->add('description', TextType::class)
            ->add('personal', EntityType::class, [
                'class' => Personal::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('team', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'teamName',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TeamMember::class,
        ]);
    }
}
