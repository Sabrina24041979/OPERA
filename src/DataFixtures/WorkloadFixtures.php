<?php

namespace App\DataFixtures;

use App\Entity\Workload;
use App\Entity\Personal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WorkloadFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Création de quelques charges de travail
        for ($i = 1; $i <= 10; $i++) {
            $workload = new Workload();
            $workload->setWorkloadLevel('Level ' . $i);
            $workload->setDate(new \DateTimeImmutable('now'));
            $workload->setComment('Comment for workload ' . $i);
            $workload->setDescription('Description for workload ' . $i);
            $workload->setHours('2 hours');

            // Récupération aléatoire d'un employé
            $employee = $this->getRandomEmployee($manager);
            $workload->setPersonal($employee);

            $manager->persist($workload);
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