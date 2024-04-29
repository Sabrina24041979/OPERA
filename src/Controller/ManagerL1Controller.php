<?php

namespace App\Controller;

use App\Entity\Manager;
use App\Entity\Personal;
use App\Repository\ManagerRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



#[IsGranted('ROLE_MANAGER')]
class ManagerL1Controller extends AbstractController
{
    #[Route('/manager/dashboard', name: 'dashboard_manager_l1')]
    public function index(ManagerRepository $managerRepository): Response
    {
        // Obtenir l'utilisateur actuel
        $user = $this->getUser();

        // Assurer que l'utilisateur est bien un instance de Manager
        if (!$user instanceof Personal) {
            throw new AccessDeniedException('Seuls les managers de niveau 1 peuvent accéder à ce tableau de bord.');
        }

        // Utiliser l'utilisateur qui est un manager pour obtenir le nombre de membres d'équipe
        $teamMembersCount = $managerRepository->countTeamMembers($user);

        return $this->render('dashboard/dashboard_manager_l1.html.twig', [
            'team_members_count' => $teamMembersCount,
        ]);
    }
}
