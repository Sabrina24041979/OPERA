<?php

namespace App\DataFixtures;


use App\Entity\Goal;
use App\Entity\Action;
use App\Entity\Category;
use App\Entity\Feedback;
use App\Entity\Personal;
use App\Entity\Interview;
use App\Entity\EmployeeSentiments;
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

        // Category
        $category = new Category();
        $category->setName('Développement');
        $category->setDescription('Tâches liées au développement du projet.');

        $manager->persist($category);

        // EmployeeSentiments
        $employeeSentiments = new EmployeeSentiments();
        $employeeSentiments->setSentimentValue('Satisfait');
        $employeeSentiments->setComment('Les employés se sentent satisfaits des conditions de travail actuelles.');

        $manager->persist($employeeSentiments);

        // Feedback
        $feedback = new Feedback();
        $feedback->setfeedbackText('Merci pour l\'organisation de la réunion, elle était très instructive !');

        $manager->persist($feedback);
        
        // Goal
        $goal = new Goal();
        $goal->setDescription('Atteindre un taux de satisfaction client de 90% d\'ici la fin de l\'année.');

        $manager->persist($goal);

        // Interview
        $interview = new Interview();
        $interview->setTitle('Entretien d\'embauche');
        $interview->setDescription('Entretien pour le poste de développeur web.');

        $manager->persist($interview);

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