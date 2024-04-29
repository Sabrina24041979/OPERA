<?php

namespace App\DataFixtures;

use App\Entity\Manager;
use App\Entity\Personal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PersonalFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d'exemples de données personnelles en fonction des propriétés créées pour l'entité Personal.
        for ($i = 1; $i <= 10; $i++) {
            $personal = new Personal();
            $personal->setUsername('U2589' . $i);
            $personal->setEmail('email_' . $i . 'sabrina.montassar@yahoo.fr');
            $personal->setPassword('123456789' . $i); 
            $personal->addRole('ROLE_MANAGER'); 
            $personal->setDepartment('Equipe développement' . $i); 
            $personal->setMatricule('310256' . $i); 
            $personal->setEntryDate(new \DateTime('2023-06-01')); 
            $personal->setExitDate(new \DateTime('2023-12-31'));
            $this->setReference("personal_" . $i , $personal);

            
            // Assigner un Manager à chaque Personal (chaque personal doit avoir un seul manager de niveau 1)
            $managerEntity = new Manager();
            $managerEntity->setFullname('Sabrina MONTASSAR'); 
            $managerEntity->setEmail('sabrina.montassar@yahoo.fr'); 
                      
            $personal->setManager($managerEntity);

            $manager->persist($managerEntity); // Persistez d'abord le Manager
            $manager->persist($personal); // Puis persister le Personal

            // $this->addReference('personal_' . $i, $personal);
          
        }

        $manager->flush();
    }
}
