<?php

namespace App\DataFixtures;

use App\Entity\Profile;
use App\Entity\Manager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfileFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d'exemples de profils
        for ($i = 1; $i <= 10; $i++) {
            $profile = new Profile();
            $profile->setLastname('Montassar');
            $profile->setFirstname('Sabrina');
            $profile->setPosition('Responsable de service');
            $profile->setBirthdate(new \DateTimeImmutable('1979-04-24'));
            $profile->setProfilePicture(null); // Optionnel, à null si non utilisé
            
            // Obtenez une référence à un manager existant
            $managerReference = $this->getReference('manager_' . rand(1, 2));
            $profile->setManager($managerReference);

            // Assurez-vous d'ajouter le profile au manager également
            $managerReference->addProfile($profile);

            $manager->persist($profile);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ManagerFixtures::class,
        ];
    }
}