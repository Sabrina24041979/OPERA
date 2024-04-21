<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ManagerRepository;

class ManagerL1Controller extends AbstractController
{
    #[Route('/manager/dashboard', name: 'dashboard_manager_l1')]
    public function index(ManagerRepository $managerRepository): Response
    {
        $teamMembersCount = $managerRepository->countTeamMembers();

        return $this->render('dashboard/dashboard_manager_l1.html.twig', [
            'team_members_count' => $teamMembersCount,
        ]);
    }
}
