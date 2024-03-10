<?php

namespace App\DataFixtures;

use App\Entity\Manager;
use App\Entity\Personal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PersonalFixtures extends Fixture
{
    private $entityManager;

    public function __construct(ObjectManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function load(ObjectManager $manager): void
    {
        // Création d'exemples de données personnelles
        for ($i = 1; $i <= 10; $i++) {
            $personal = new Personal();
            $personal->setUsername('username_' . $i);
            $personal->setEmail('email_' . $i . '@example.com');
            $personal->setPassword('123456789' . $i); 
            $personal->setRole('Responsable de Pôle'); 
            $personal->setDepartment('Equipe développement' . $i); 
            $personal->setMatricule('310256' . $i); 
            $personal->setEntryDate(new \DateTime('2023-06-01')); 
            $personal->setExitDate(new \DateTime('2023-12-31'));
            
            // Assigner un Manager à chaque Personal
            $managerEntity = new Manager();
            $managerEntity->setFullname('Sabrina MONTASSAR'); 
            $managerEntity->setEmail('sabrina.montassar@yahoo.fr'); 
            // Assurez-vous que les autres attributs du Manager sont correctement définis
            
            $personal->setManager($managerEntity);

            $this->entityManager->persist($managerEntity); // Persistez d'abord le Manager
            $this->entityManager->persist($personal); // Puis le Personal

            $this->addReference('personal_' . $i, $personal);
        }

        $this->entityManager->flush();
    }
}
