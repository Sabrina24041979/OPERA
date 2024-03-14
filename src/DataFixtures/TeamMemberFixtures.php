<?php

namespace App\DataFixtures;

use App\Entity\TeamMember;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TeamMemberFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Création d'exemples de membres d'équipe
        for ($i = 1; $i <= 10; $i++) {
            $teamMember = new TeamMember();
            $teamMember->setRoleInTeam('Collaborateur'); // Rôle dans l'équipe
            $teamMember->setJoinedAt(new \DateTimeImmutable('now')); // Date de rejoindre l'équipe
            $teamMember->setStatus('Actif'); // Statut du membre d'équipe
            $teamMember->setName('Membre ' . $i); // Nom du membre d'équipe
            $teamMember->setDescription('Description du membre ' . $i); // Description du membre d'équipe

            // Associer des personnes (Personal) à chaque membre d'équipe
            for ($j = 1; $j <= 3; $j++) {
                $personalReference = $this->getReference('personal_' . rand(1,10));
                $teamMember->addPersonal($personalReference);
            }

            // Associer une équipe à chaque membre d'équipe
            $teamReference = $this->getReference('team_' . rand(1, 5));
            $teamMember->setTeam($teamReference);

            $manager->persist($teamMember);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PersonalFixtures::class,
            TeamFixtures::class,
        ];
    }
}