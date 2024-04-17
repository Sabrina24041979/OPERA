<?php

namespace App\Service;

use App\Entity\Action;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class ActionManager
{
    private $entityManager;
    private $security;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    public function create(Action $action)
    {
        $this->entityManager->persist($action);
        $this->entityManager->flush();
    }

    public function update(Action $action)
    {
        $this->entityManager->flush();
    }

    public function delete(Action $action)
    {
        $this->entityManager->remove($action);
        $this->entityManager->flush();
    }

    public function getById(int $id): ?Action
    {
        return $this->entityManager->getRepository(Action::class)->find($id);
    }

    public function getActionsByUser($userId)
    {
        return $this->entityManager->getRepository(Action::class)
            ->findBy(['user' => $userId]);
    }

    /**
     * Je filtre les actions par état d'atteinte, ce qui permet au manager de visualiser rapidement les progrès.
     */
    public function getActionsByStatus($status)
    {
        return $this->entityManager->getRepository(Action::class)
            ->findBy(['status' => $status], ['deadline' => 'ASC']);
    }

    /**
     * Je récupère les actions urgentes qui nécessitent une attention immédiate (deadline proche).
     */
    public function getUrgentActions()
    {
        $today = new \DateTime();
        $nextWeek = (clone $today)->modify('+7 days');

        return $this->entityManager->getRepository(Action::class)
            ->createQueryBuilder('a')
            ->where('a.deadline BETWEEN :today AND :nextWeek')
            ->setParameter('today', $today)
            ->setParameter('nextWeek', $nextWeek)
            ->getQuery()
            ->getResult();
    }

    /**
     * Je permets aux managers de voir les actions terminées pour un retour d'expérience et des améliorations futures.
     */
    public function getCompletedActions()
    {
        return $this->entityManager->getRepository(Action::class)
            ->findBy(['status' => 'completed'], ['completedDate' => 'DESC']);
    }

    /**
     * Je fournis un rapport des actions par collaborateur pour améliorer le suivi individuel.
     */
    public function getActionReportByUser($userId)
    {
        return $this->entityManager->getRepository(Action::class)
            ->findBy(['user' => $userId], ['priority' => 'ASC', 'deadline' => 'ASC']);
    }
}
