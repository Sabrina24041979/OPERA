<?php

namespace App\DataFixtures;

use App\Entity\Goal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GoalFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Création des objectifs
        for ($i = 1; $i <= 10; $i++) {
            $goal = new Goal();
            $goal->setDescription('Objectif ' . $i);
            $goal->setDeadline(new \DateTimeImmutable('2024-12-31'));
            $goal->setStatus('En cours');
            $goal->setPriority('Haute');
            $goal->setCreatedAt(new \DateTimeImmutable('now'));
            $goal->setUpdatedAt(new \DateTimeImmutable('now'));

            // Obtenez une référence à un utilisateur existant
            $personalReference = $this->getReference('personal_' . rand(1, 5));
            $goal->setPersonal($personalReference);

            // Obtenez une référence à une catégorie existante
            $categoryReference = $this->getReference('category_' . rand(1, 3));
            $goal->setCategory($categoryReference);

            $manager->persist($goal);
        }

        // Enregistrer les objectifs en base de données
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PersonalFixtures::class,
            CategoryFixtures::class,
        ];
    }
}