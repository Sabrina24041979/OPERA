<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;

class UserDashboardController extends AbstractController
{
    private $security;
    private $taskRepository;
    private $userRepository;

    // Injection des dépendances Security, TaskRepository et UserRepository
    public function __construct(Security $security, TaskRepository $taskRepository, UserRepository $userRepository)
    {
        $this->security = $security;
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
    }

    #[Route("/dashboard", name: "user_dashboard")]
    public function index(): Response
    {
        $user = $this->security->getUser();
        $dashboardData = $this->getDashboardDataForRole($user);

        return $this->render('dashboard/index.html.twig', [
            'dashboardData' => $dashboardData
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
