<?php

namespace App\DataFixtures;

use App\Entity\Team;
use App\Entity\Personal;
use App\Entity\Manager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TeamFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d'exemples d'équipes
        for ($i = 1; $i <= 5; $i++) {
            $team = new Team();
            $team->setTeamName('Team ' . $i);
            $team->setDescription('Description of Team ' . $i);
            $team->setCreatedAt(new \DateTimeImmutable('2024-01-01'));

            // Obtenez une référence à un manager existant
            $managerReference = $this->getReference('manager_' . $i);
            $team->setManager($managerReference);

            // Associer des membres de l'équipe (Personal) à chaque équipe
            for ($j = 1; $j <= 3; $j++) {
                $personalReference = $this->getReference('personal_' . (($i - 1) * 3 + $j));
                $team->addMember($personalReference);
            }

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