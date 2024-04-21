<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;

class UserDashboardController extends AbstractController
{
    private $taskRepository;
    private $userRepository;

    // Simplification du constructeur
    public function __construct(TaskRepository $taskRepository, UserRepository $userRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
    }

    #[Route("/dashboard/user", name: "dashboard_user")]
    public function index(): Response {
        $user = $this->getUser(); // Utilisation de getUser() de AbstractController
        $tasks = $this->taskRepository->findBy(['user' => $user]);
    
        return $this->render('dashboard/index.html.twig', [
            'tasks' => $tasks,
        ]);
    }
    
    // Méthode pour récupérer les données de tableau de bord en fonction du rôle de l'utilisateur
    private function getDashboardDataForRole($user)
    {
        if (in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            return [
                'tasks' => $this->taskRepository->findAll(),
                'users' => $this->userRepository->findAll()
            ];
        } elseif (in_array('ROLE_USER', $user->getRoles(), true)) {
            return [
                'tasks' => $this->taskRepository->findBy(['user' => $user]),
            ];
        }
        
        return [];
    }
}
