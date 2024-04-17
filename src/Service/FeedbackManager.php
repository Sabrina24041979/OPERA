<?php

namespace App\Service;

use App\Entity\Feedback;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class FeedbackManager
{
    private $entityManager;
    private $security;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    /**
     * Je crée un feedback dans la base de données.
     */
    public function createFeedback(Feedback $feedback)
    {
        $feedback->setCreator($this->security->getUser());  // J'attribue le feedback à l'utilisateur connecté
        $this->entityManager->persist($feedback);
        $this->entityManager->flush();
    }

    /**
     * Je mets à jour les informations d'un feedback existant.
     */
    public function updateFeedback()
    {
        $this->entityManager->flush(); // Les modifications sont persistées automatiquement
    }

    /**
     * Je supprime un feedback spécifique de la base de données.
     */
    public function deleteFeedback(Feedback $feedback)
    {
        $this->entityManager->remove($feedback);
        $this->entityManager->flush();
    }

    /**
     * Je récupère un feedback par son identifiant.
     */
    public function getFeedbackById(int $id): ?Feedback
    {
        return $this->entityManager->getRepository(Feedback::class)->find($id);
    }

    /**
     * Je liste tous les feedbacks disponibles pour l'utilisateur connecté ou pour un manager spécifique.
     */
    public function getAllFeedbacksForUser($userId)
    {
        return $this->entityManager->getRepository(Feedback::class)
            ->findBy(['creator' => $userId], ['createdAt' => 'DESC']);
    }

    /**
     * Je filtre les feedbacks selon des critères spécifiques comme la date ou le status.
     */
    public function filterFeedbacks($criteria)
    {
        return $this->entityManager->getRepository(Feedback::class)
            ->findBy($criteria, ['createdAt' => 'DESC']);
    }
}

