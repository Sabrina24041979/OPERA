<?php

namespace App\DataFixtures;

use App\Entity\TypeInterview;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeInterviewFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création des types d'entretien
        $typeInterview1 = new TypeInterview();
        $typeInterview1->setName('Entretien téléphonique');
        $typeInterview1->setDescription('Entretien initial par téléphone');
        $manager->persist($typeInterview1);

        $typeInterview2 = new TypeInterview();
        $typeInterview2->setName('Entretien en personne');
        $typeInterview2->setDescription('Entretien en face à face dans nos bureaux');
        $manager->persist($typeInterview2);

        // Enregistrer les types d'entretien en base de données
        $manager->flush();
    }
}