<?php

namespace App\Controller;

use App\Entity\Personal;
use App\Entity\Team;
use App\Form\PersonalType;
use App\Form\TeamType;
use App\Repository\PersonalRepository;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/personals', name: 'admin_personals_manage')]
    public function managePersonals(PersonalRepository $personalRepository): Response
    {
        // Je récupère tous les personnels pour les afficher dans la vue d'administration
        $personals = $personalRepository->findAll();

        return $this->render('admin/personals_manage.html.twig', [
            'personals' => $personals,
        ]);
    }

    #[Route('/teams', name: 'admin_teams_overview')]
    public function overviewTeams(TeamRepository $teamRepository): Response
    {
        // Je récupère toutes les équipes pour les afficher dans la vue d'administration
        $teams = $teamRepository->findAll();

        return $this->render('admin/teams_overview.html.twig', [
            'teams' => $teams,
        ]);
    }

    //Méthode pour créer un personnel

    #[Route('/personal/new', name: 'admin_personal_new', methods: ['GET', 'POST'])]
    public function newPersonal(Request $request, EntityManagerInterface $entityManager): Response
    {
        $personal = new Personal();
        $form = $this->createForm(PersonalType::class, $personal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($personal);
            $entityManager->flush();

            return $this->redirectToRoute('admin_personals_manage');
        }

        return $this->render('admin/personal_new.html.twig', [
            'personal' => $personal,
            'form' => $form->createView(),
        ]);
    }

        // Méthode pour éditer un personnel
    #[Route('/personal/edit/{id}', name: 'admin_personal_edit', methods: ['GET', 'POST'])]
    public function editPersonal(Request $request, Personal $personal, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PersonalType::class, $personal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_personals_manage');
        }

        return $this->render('admin/personal_edit.html.twig', [
            'personal' => $personal,
            'form' => $form->createView(),
        ]);
    }

    // Méthode pour supprimer un personnel
    #[Route('/personal/delete/{id}', name: 'admin_personal_delete', methods: ['POST'])]
    public function deletePersonal(Request $request, Personal $personal, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personal->getId(), $request->request->get('_token'))) {
            $entityManager->remove($personal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_personals_manage');
    }

    // Méthode pour créer une nouvelle équipe
    #[Route('/team/new', name: 'admin_team_new', methods: ['GET', 'POST'])]
    public function createTeam(Request $request, EntityManagerInterface $entityManager): Response
    {
        $team = new Team(); // Je crée une nouvelle instance de l'entité Team
        $form = $this->createForm(TeamType::class, $team); // Je crée le formulaire pour cette équipe
        $form->handleRequest($request); // Je gère la requête

        if ($form->isSubmitted() && $form->isValid()) { // Je vérifie si le formulaire a été soumis et est valide
            $entityManager->persist($team); // J'ajoute l'équipe dans la base de données
            $entityManager->flush(); // J'enregistre les changements

            $this->addFlash('success', 'Équipe créée avec succès !'); // Je notifie l'utilisateur de la réussite
            return $this->redirectToRoute('admin_teams_overview'); // Je redirige vers la vue d'ensemble des équipes
        }

        // Je retourne la vue avec le formulaire de création d'équipe
        return $this->render('admin/team_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Méthode pour éditer une équipe
    #[Route('/team/edit/{id}', name: 'admin_team_edit', methods: ['GET', 'POST'])]
    public function editTeam(Request $request, Team $team, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_teams_overview');
        }

        return $this->render('admin/team_edit.html.twig', [
            'team' => $team,
            'form' => $form->createView(),
        ]);
    }

    // Méthode pour supprimer une équipe
    #[Route('/team/delete/{id}', name: 'admin_team_delete', methods: ['POST'])]
    public function deleteTeam(Request $request, Team $team, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$team->getId(), $request->request->get('_token'))) {
            $entityManager->remove($team);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_teams_overview');
    }

    // Méthode pour afficher et gérer les performances des employés
    #[Route('/performances', name: 'admin_performances', methods: ['GET'])]
    public function managePerformances(PerformanceRepository $performanceRepository): Response
    {
        // Je récupère les données des performances pour les afficher
        $performances = $performanceRepository->findAll();

        // Je retourne la vue des performances avec les données récupérées
        return $this->render('admin/performances_manage.html.twig', [
            'performances' => $performances,
        ]);
    }

    // Méthode pour gérer les évaluations des employés
    #[Route('/evaluations', name: 'admin_evaluations', methods: ['GET'])]
    public function manageEvaluations(EvaluationRepository $evaluationRepository): Response
    {
        // Je récupère les évaluations pour les afficher
        $evaluations = $evaluationRepository->findAll();

        // Je retourne la vue des évaluations
        return $this->render('admin/evaluations_manage.html.twig', [
            'evaluations' => $evaluations,
        ]);
    }

    // Méthode pour afficher et modifier les permissions des utilisateurs
    #[Route('/permissions', name: 'admin_permissions', methods: ['GET', 'POST'])]
    public function managePermissions(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        // Je récupère tous les utilisateurs
        $users = $userRepository->findAll();

        // Je crée un formulaire pour chaque utilisateur pour modifier ses permissions
        $forms = [];
        foreach ($users as $user) {
            $form = $this->createForm(UserPermissionsType::class, $user);
            $form->handleRequest($request);
            $forms[$user->getId()] = $form->createView();

            // Si le formulaire est soumis et valide, je mets à jour les permissions
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($user);
                $entityManager->flush();

                // Redirection pour éviter la resoumission du formulaire
                return $this->redirectToRoute('admin_permissions');
            }
        }

        // Je retourne la vue des permissions avec les utilisateurs et leurs formulaires
        return $this->render('admin/permissions_manage.html.twig', [
            'users' => $users,
            'forms' => $forms,
        ]);
    }

    // Méthode pour afficher et modifier la configuration de l'application
    #[Route('/settings', name: 'admin_settings', methods: ['GET', 'POST'])]
    public function manageSettings(Request $request, ConfigRepository $configRepository, EntityManagerInterface $entityManager): Response
    {
        // Logique pour afficher les configurations actuelles et permettre leur modification

        return $this->render('admin/settings_manage.html.twig', [
            // 'settings' => $settings,
        ]);
    }

}
