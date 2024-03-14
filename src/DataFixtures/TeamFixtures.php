<?php

namespace App\DataFixtures;

use App\Entity\Team;
use App\Entity\Manager;
use App\Entity\Personal;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TeamFixtures extends Fixture Implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Création d'exemples d'équipes
        for ($i = 1; $i <= 5; $i++) {
            $team = new Team();
            $team->setTeamName('Team ' . $i);
            $team->setDescription('Description ode l\'équipe ' . $i);
            $team->setCreatedAt(new \DateTimeImmutable('2024-01-01'));

            // Obtenez une référence à un manager existant
            $managerReference = $this->getReference('manager_' . rand(1 , 2));
            $team->setManager($managerReference);

            // Associer des membres de l'équipe (Personal) à chaque équipe
            for ($j = 1; $j <= 3; $j++) {
                $personalReference = $this->getReference('personal_' . rand(1,10));
                $team->addMember($personalReference);
            }
            $this->setReference("team_" . $i, $team);
            $manager->persist($team);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PersonalFixtures::class,
            ManagerFixtures::class,
        ];
    }
}