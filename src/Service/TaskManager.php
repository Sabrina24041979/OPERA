<?php

namespace App\Service;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;

class TaskManager
{
    private $taskRepository;
    private $entityManager;

    // Je déclare les dépendances dont j'ai besoin pour la gestion des tâches.
    public function __construct(TaskRepository $taskRepository, EntityManagerInterface $entityManager)
    {
        $this->taskRepository = $taskRepository;
        $this->entityManager = $entityManager;
    }

    // Je récupère toutes les tâches.
    public function getAllTasks()
    {
        return $this->taskRepository->findAll();
    }

    // Je sauvegarde une nouvelle tâche ou une mise à jour d'une tâche existante.
    public function saveTask(Task $task)
    {
        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }

    // Je supprime une tâche spécifique.
    public function deleteTask(Task $task)
    {
        $this->entityManager->remove($task);
        $this->entityManager->flush();
    }

    // Je marque une tâche comme complétée.
    public function completeTask(Task $task)
    {
        $task->setCompleted(true);
        $this->entityManager->flush();
    }
}
