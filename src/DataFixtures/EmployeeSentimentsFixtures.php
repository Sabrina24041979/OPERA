<?php

namespace App\DataFixtures;

use App\Entity\EmployeeSentiments;
use App\Entity\Personal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EmployeeSentimentsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Création de quelques sentiments d'employés
        for ($i = 1; $i <= 10; $i++) {
            $employeeSentiment = new EmployeeSentiments();
            $employeeSentiment->setSentimentValue('Sentiment ' . $i);
            $employeeSentiment->setDate(new \DateTimeImmutable('now'));
            $employeeSentiment->setComment('Commentaire du sentiment ' . $i);
            $employeeSentiment->setCategory('Categorie ' . $i);
            $employeeSentiment->setIntensity('Intensité ' . $i);

            // Récupération aléatoire d'un employé
            $employee = $this->getRandomEmployee($manager);
            $employeeSentiment->setPersonal($employee);

            $manager->persist($employeeSentiment);
        }

        $manager->flush();
    }

    private function getRandomEmployee(ObjectManager $manager): ?Personal
    {
        // Récupération de tous les employés
        $employees = $manager->getRepository(Personal::class)->findAll();

        // Sélection aléatoire d'un employé
        $randomIndex = array_rand($employees);
        return $employees[$randomIndex];
    }

    public function getDependencies(): array
    {
        return [
            PersonalFixtures::class,
        ];
    }
}