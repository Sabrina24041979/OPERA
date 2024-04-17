<?php

namespace App\Service;

use App\Entity\Objective;
use App\Repository\ObjectiveRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Je gère les opérations liées aux objectifs pour l'application OPERA.
 */
class ObjectiveManager
{
    private $entityManager;
    private $objectiveRepository;

    /**
     * Le constructeur injecte les dépendances nécessaires, notamment l'EntityManager et le ObjectiveRepository.
     */
    public function __construct(EntityManagerInterface $entityManager, ObjectiveRepository $objectiveRepository)
    {
        $this->entityManager = $entityManager;
        $this->objectiveRepository = $objectiveRepository;
    }

    /**
     * Je crée un nouvel objectif et le sauvegarde.
     */
    public function createObjective(string $title, string $description, \DateTime $startDate, \DateTime $endDate, int $completionStatus): Objective
    {
        $objective = new Objective();
        $objective->setTitle($title);
        $objective->setDescription($description);
        $objective->setStartDate($startDate);
        $objective->setEndDate($endDate);
        $objective->setCompletionStatus($completionStatus);
        
        $this->entityManager->persist($objective);
        $this->entityManager->flush();

        return $objective;
    }

    /**
     * Je mets à jour un objectif existant.
     */
    public function updateObjective(Objective $objective, string $title, string $description, \DateTime $startDate, \DateTime $endDate, int $completionStatus): Objective
    {
        $objective->setTitle($title);
        $objective->setDescription($description);
        $objective->setStartDate($startDate);
        $objective->setEndDate($endDate);
        $objective->setCompletionStatus($completionStatus);

        $this->entityManager->flush();

        return $objective;
    }

    /**
     * Je supprime un objectif de la base de données.
     */
    public function deleteObjective(Objective $objective)
    {
        $this->entityManager->remove($objective);
        $this->entityManager->flush();
    }

    /**
     * Je récupère un objectif par son identifiant.
     */
    public function getObjectiveById(int $id): ?Objective
    {
        return $this->objectiveRepository->find($id);
    }

    /**
     * Je récupère tous les objectifs disponibles.
     */
    public function getAllObjectives(): array
    {
        return $this->objectiveRepository->findAll();
    }
}
