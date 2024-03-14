<?php

namespace App\DataFixtures;

use App\Entity\Manager;
use App\Entity\Personal;
use App\Entity\Profile;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProfileFixtures extends Fixture implements DependentFixtureInterface
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
            $personalReference = $this->getReference('personal_' . $i);
            $profile->setPersonal($personalReference);

            $manager->persist($profile);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PersonalFixtures::class,
        ];
    }
}