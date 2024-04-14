<?php

namespace App\Controller; // Assure-toi que l'espace de nommage est correct selon la structure de ton projet

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
      
    #[Route("/tasks", name: "task_complete")]
     
    public function index(TaskRepository $taskRepository): Response
    {
        // Je récupère toutes les tâches de la base de données
        $tasks = $taskRepository->findAll();
        
        // Je renvoie ces tâches au template pour affichage
        return $this->render('tasks/index.html.twig', [
            'tasks' => $tasks
        ]);
    }

    //Je définis une route pour marquer une tâche comme complétée.
     
    #[Route("/tasks/{id}/complete", name: "task_complete", methods: ["POST"])]
    public function complete(int $id, TaskRepository $taskRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        // Je recherche la tâche par son ID
        $task = $taskRepository->find($id);
        
        // Si la tâche n'existe pas, je renvoie un message d'erreur
        if (!$task) {
            return $this->json(['error' => 'Task not found'], 404);
        }

        // Je marque la tâche comme complétée
        $task->setCompleted(true);
        
        // J'enregistre les changements dans la base de données
        $entityManager->persist($task);
        $entityManager->flush();

        // Je renvoie un message de succès
        return $this->json(['message' => 'Task completed successfully']);
    }
}
