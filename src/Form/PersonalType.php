<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\Manager;
use App\Entity\Profile;
use App\Entity\Personal;
use App\Entity\TeamMember;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('password')

            ->add('entry_date', null, [
                'widget' => 'single_text',
            ])
            ->add('exit_date', null, [
                'widget' => 'single_text',
            ])
            ->add('matricule')
            ->add('department')
            // ->add('firstConnexion', null, [
            //     'widget' => 'single_text',
            // ])
            ->add('type_contract')
            ->add('status')
            ->add('SPC')
            ->add('profile', EntityType::class, [
                'class' => Profile::class,
                'choice_label' => 'id',
            ])
            ->add('teams', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('manager', EntityType::class, [
                'class' => Manager::class,
                'choice_label' => 'id',
                'query_builder' => function (EntityRepository $managerRepository): QueryBuilder {
                    return $managerRepository->createQueryBuilder('m')
                        ->orderBy('m.fullname', 'ASC');
                },
                'choice_label' => 'fullname',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personal::class,
        ]);
    }
}
