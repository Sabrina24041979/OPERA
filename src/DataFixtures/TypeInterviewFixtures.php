<?php

namespace App\DataFixtures;

use App\Entity\TypeInterview;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TypeInterviewFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création des types d'entretien qui seront enregistrés en base de données.

        $typeInterview1 = new TypeInterview();
        $typeInterview1->setName('Entretien annuel');
        $typeInterview1->setDescription('Echange sur le sperformances annuels et les objectifs fixés lors de l\'entretien annuel de N-1');
        $this->setReference("type_interview_1", $typeInterview1);
        $manager->persist($typeInterview1);

        $typeInterview2 = new TypeInterview();
        $typeInterview2->setName('Entretien de performance');
        $typeInterview2->setDescription('Vérification des résultats du collaborateur');
        $this->setReference("type_interview_2", $typeInterview2);
        $manager->persist($typeInterview2);

        $typeInterview3 = new TypeInterview();
        $typeInterview3->setName('Entretien de recrutement');
        $typeInterview3->setDescription('Entretien d\'embauche');
        $this->setReference("type_interview_3", $typeInterview3);
        $manager->persist($typeInterview3);

        $typeInterview4 = new TypeInterview();
        $typeInterview4->setName('Entretien de recadrage');
        $typeInterview4->setDescription('Entretien de recadrage');
        $manager->persist($typeInterview4);

        $typeInterview5 = new TypeInterview();
        $typeInterview5->setName('One to One');
        $typeInterview5->setDescription('Briefing régulier avec le collaborateur pour suivi des objectifs et plan d\'actions');
        $manager->persist($typeInterview5);

        $typeInterview6 = new TypeInterview();
        $typeInterview6->setName('Entretien professionnel');
        $typeInterview6->setDescription('Entretien obligatoire tous les 2 ans. Permet de faire le point sur les formations et les ');
        $manager->persist($typeInterview6);

        $typeInterview7 = new TypeInterview();
        $typeInterview7->setName('Entretien fin de contrat ');
        $typeInterview7->setDescription('Entretien obligatoire tous les 2 ans. Permet de faire le point sur les formations et les ');
        $manager->persist($typeInterview7);

       
        $manager->flush();
    }
    
}