<?php

namespace App\EventListener;

use DateInterval;
use App\Entity\Personal;
use App\Entity\Interview;
use App\Entity\TypeInterview;
use App\Event\PersonalCreatedEvent;
use App\Repository\InterviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TypeInterviewRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PersonalCreatedListener implements EventSubscriberInterface
{
    private $em;
    private $security;
    private $typeInterviewRepo;
    private $interviewRepository;

    public function __construct(
        EntityManagerInterface $em,
        Security $security,
        TypeInterviewRepository $typeInterviewRepo,
        InterviewRepository $interviewRepository
    ) {
        $this->em = $em;
        $this->security = $security;
        $this->typeInterviewRepo = $typeInterviewRepo;
        $this->interviewRepository = $interviewRepository;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            PersonalCreatedEvent::NAME => 'onPersonalCreated',
        ];
    }

    public function onPersonalCreated(PersonalCreatedEvent $event)
    {
        $personal = $event->getPersonal();
        $interviewer = $this->security->getUser();
        $typesInterview = $this->typeInterviewRepo->findAutomaticInterview(1);
        $exitDate = $this->getExitDate($personal);

        foreach ($typesInterview as $typeInterview) {
            $name = $typeInterview->getName();

            $interval = $typeInterview->getIntervalDate();

            if ($interval === null) {
                $interval = $this->getSpecificInterval($typeInterview, $personal);
            }

            $interview = new Interview();
            $interview->setInterviewee($personal);
            $interview->setTypeInterview($typeInterview);
            $interview->setInterviewer($interviewer);
            $interview->setStatus('planifié');

            $date = new \DateTime();
            $dateInterval = new DateInterval($interval);
            $date->add($dateInterval);

            // Ajuster la date pour qu'elle soit un jour ouvrable et que l'interviewer soit disponible
            $date = $this->findNextAvailableDate($date, $interviewer);

            // Vérifier que la date de l'entretien n'est pas après la fin du contrat
            if ($exitDate !== null && $date > $exitDate) {
                continue; // Skip scheduling this interview if it falls after the contract end date
            }

            $interview->setDate($date);

            $this->em->persist($interview);
        }

        $this->em->flush();
    }

    private function findNextAvailableDate(\DateTime $date, $interviewer): \DateTime
    {
        $date = $this->adjustToWorkday($date);

        while (true) {
            $interviewCount = $this->interviewRepository->countInterviewsForInterviewerOnDate($interviewer, $date);

            if ($interviewCount < 2) {
                return $date;
            }

            $date->modify('+1 day');
            $date = $this->adjustToWorkday($date);
        }
    }

    private function adjustToWorkday(\DateTime $date): \DateTime
    {
        $dayOfWeek = $date->format('N');

        if ($dayOfWeek >= 6) { // 6 = Samedi, 7 = Dimanche
            // Ajouter des jours jusqu'à atteindre le prochain lundi
            $daysToAdd = 8 - $dayOfWeek;
            $date->add(new \DateInterval("P{$daysToAdd}D"));
        }

        return $date;
    }

    private function getSpecificInterval(TypeInterview $typeInterview, Personal $personal): ?string
    {
        if ($typeInterview->getName() === 'Entretien fin période d\'essai') {
            switch ($personal->getSPC()) {
                case 'employé':
                    return 'P30D'; // 1 mois
                case 'agent de maitrise':
                    return 'P90D'; // 3 mois
                case 'cadre':
                    return 'P120D'; // 4 mois
                default:
                    return 'P30D'; // Valeur par défaut si la SPC n'est pas reconnue
            }
        }
        return null; // Ajout d'un retour par défaut
    }

    private function getExitDate(Personal $personal): ?\DateTime
    {
        return $personal->getExitDate();
    }
}
