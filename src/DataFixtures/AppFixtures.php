<?php

namespace App\DataFixtures;

use App\Entity\Action;
use App\Entity\Personal;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Action
        $action = new Action();
        $action->setName('Réaliser la documentation du projet');
        $action->setDescription('Créer et finaliser la documentation technique et utilisateur du projet OPERA.');

        $manager->persist($action);

        
         // Créer un utilisateur factice
         $personal = new Personal();
         $personal->setUsername('sabrina_m');
         $personal->setEmail('sabrina@example.com');
         $personal->setPassword('123456789');
 
         $manager->persist($personal);
 
         // Flusher les changements
         $manager->flush();
    }
}