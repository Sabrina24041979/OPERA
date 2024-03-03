<?php

namespace App\DataFixtures;


use App\Entity\Goal;
use App\Entity\Team;
use App\Entity\Action;
use App\Entity\Profile;
use App\Entity\Category;
use App\Entity\Feedback;
use App\Entity\Personal;
use App\Entity\Resource;
use App\Entity\Workload;
use App\Entity\Interview;
use App\Entity\TeamMember;
use App\Entity\TypeInterview;
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

         // Profile
        $profile = new Profile();
        $profile->setFullname('Sabrina');
        $profile->setLastname('Montassar');

        $manager->persist($profile);

        // Resource
        $resource = new Resource();
        $resource->setTitle('Les fondamentaux du Management');
        $resource->setDescription('Les fondamentaux du management se réfèrent aux principes, pratiques et compétences de base qui sont essentiels pour la gestion efficace d\'une équipe ou d\'une organisation.');

        $manager->persist($resource);

          // Team
          $team = new Team();
          $team->setTeamName('Équipe de développement');
          $team->setDescription('Équipe chargée du développement du projet OPERA.');
  
          $manager->persist($team);

          // TeamMember
        $teamMember = new TeamMember();
        $teamMember->setName('Sabrina MONTASSAR');
        $teamMember->setRoleInTeam('Chef de rojet');
        $teamMember->setDescription('Membre de l\'équipe de développement.');

        $manager->persist($teamMember);

        // TypeInterview
        $typeInterview = new TypeInterview();
        $typeInterview->setName('Entretien de recrutement');
        $typeInterview->setDescription('Entretien utilisé pour recruter de nouveaux employés.');

        $manager->persist($typeInterview);

        // Workload
        $workload = new Workload();
        $workload->setDescription('Charge de travail pour le mois de mars 2024.');
        $workload->setHours(160);

        $manager->persist($workload);
    }
      

}