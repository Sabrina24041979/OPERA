<?php

namespace App\DataFixtures;

use App\Entity\Manager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ManagerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d'exemples de données pour les managers
        $manager1 = new Manager();
        // Définir les attributs du manager 1
        $manager1->setFullname('Sabrina SAYARI ');
        $manager1->setEmail('sabrina_sayari_montassar@yahoo.fr');
        $manager1->setPosition('1');
        $manager1->setMatricule('310257');
        $manager1->setDepartment('Informatique');

        

        $manager2 = new Manager();
        // Définir les attributs du manager 2
        $manager2->setFullname('sabrine.montassar');
        $manager2->setEmail('sabrina.montassar.04@gmail.com');
        $manager1->setPosition('2');
        $manager1->setMatricule('310258');
        $manager1->setDepartment('Informatique');
        
        
        $manager->persist($manager1);
        $manager->persist($manager2);
        $manager->flush();

        // Ajouter des références pour les managers
        $this->addReference('manager_1', $manager1);
        $this->addReference('manager_2', $manager2);
    }
}