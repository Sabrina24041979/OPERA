<?php

namespace App\DataFixtures;

use App\Entity\Interview;
use App\Entity\Personal;
use App\Entity\TypeInterview;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InterviewFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d'exemples d'entretiens
        for ($i = 1; $i <= 5; $i++) {
            $interview = new Interview();
            $interview->setTitle('Entretien ' . $i); // Titre de l'entretien
            $interview->setDescription('Description de l\'entretien ' . $i); // Description de l'entretien
            $interview->setDate(new \DateTimeImmutable('now')); // Date de l'entretien
            $interview->setStatus('En attente'); // Statut de l'entretien
            
            // Associer un interviewer (Personal) à chaque entretien
            $interviewerReference = $this->getReference('personal_' . $i);
            $interview->setInterviewer($interviewerReference);
            
            // Associer un interviewee (Personal) à chaque entretien
            $intervieweeReference = $this->getReference('personal_' . ($i + 5)); // Supposons que les 5 premières références sont pour les intervieweurs
            $interview->setInterviewee($intervieweeReference);
            
            // Associer un type d'entretien à chaque entretien
            $typeInterviewReference = $this->getReference('type_interview_' . rand(1, 3)); // Supposons que vous avez 3 types d'entretien
            $interview->setTypeInterview($typeInterviewReference);
            
            $manager->persist($interview);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PersonalFixtures::class,
            TypeInterviewFixtures::class,
        ];
    }
}