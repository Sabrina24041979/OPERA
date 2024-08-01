<?php

// J'inclus les namespaces nécessaires pour les fonctionnalités que je vais utiliser.

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamType;
use App\Entity\Personal;
use App\Form\PersonalType;
use App\Service\ConfigService;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use App\Repository\ConfigRepository;
use App\Form\PersonalPermissionsType;
use App\Repository\PersonalRepository;
use App\Repository\EvaluationRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PerformanceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin')]
class AdminController extends AbstractController
{
    private $configService;

    // Je déclare une propriété pour ConfigService et je l'injecte via le constructeur
    public function __construct(ConfigService $configService)
    {
        $this->configService = $configService;
    }

    // #[Route('/personal/delete/{id}', name: 'admin_personal_delete', methods: ['POST'])]
    // public function deletePersonal(Request $request, Personal $personal, EntityManagerInterface $entityManager): Response
    // {
    //     $this->denyAccessUnlessGranted('ROLE_ADMIN'); // Assurez-vous que seul un admin peut supprimer un personnel
    //     if ($this->isCsrfTokenValid('delete'.$personal->getId(), $request->request->get('_token'))) {
    //         $entityManager->remove($personal);
    //         $entityManager->flush();
    //         $this->addFlash('success', 'Personnel supprimé avec succès.');
    //     }

    //     return $this->redirectToRoute('admin_personals_manage');
    // }

    #[Route('/admin/user/management', name: 'admin_user_management', methods: ['GET'])]
    public function manageUsers(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('admin/manage_users.html.twig', ['users' => $users]);
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
            // Entrer les informations recuillis dans l'objet personal
            // Envoyer en BDD

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
        if ($this->isCsrfTokenValid('delete' . $personal->getId(), $request->request->get('_token'))) {
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
        if ($this->isCsrfTokenValid('delete' . $team->getId(), $request->request->get('_token'))) {
            $entityManager->remove($team);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_teams_overview');
    }

    // Méthode pour afficher et modifier les permissions des utilisateurs
    #[Route('/permissions', name: 'admin_permissions', methods: ['GET', 'POST'])]
    public function managePermissions(Request $request, PersonalRepository $personalRepository, EntityManagerInterface $entityManager): Response
    {
        // Je récupère tous les utilisateurs
        $personals = $personalRepository->findAll();

        // Je crée un formulaire pour chaque utilisateur pour modifier ses permissions
        $forms = [];
        foreach ($personals as $personal) {
            $form = $this->createForm(PersonalPermissionsType::class, $personal);
            $form->handleRequest($request);
            $forms[$personal->getId()] = $form->createView();

            // Si le formulaire est soumis et valide, je mets à jour les permissions
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($personal);
                $entityManager->flush();

                // Redirection pour éviter la resoumission du formulaire
                return $this->redirectToRoute('admin_permissions');
            }
        }

        // Je retourne la vue des permissions avec les utilisateurs et leurs formulaires
        return $this->render('admin/permissions_manage.html.twig', [
            'personals' => $personals,
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

    #[Route('/admin/settings/save', name: 'admin_settings_save', methods: ['POST'])]
    public function saveSettings(Request $request, ConfigService $configService): Response
    {
        // Vérifier et enregistrer les paramètres ici
        return $this->redirectToRoute('admin_settings');
    }



    #[Route('/dashboard', name: 'admin_dashboard')]
    public function dashboard(PersonalRepository $personalRepository): Response
    {

        // Je récupère les données nécessaires.
        // Imaginons que je souhaite obtenir le nombre total d'utilisateurs et le nombre de nouveaux utilisateurs de cette semaine :
        $totalPersonals = [];
        $newPersonalsThisWeek = [];

        // De même, je peux récupérer d'autres données nécessaires, comme des alertes, des statistiques sur d'autres entités, etc.

        // Je prépare un tableau avec toutes les données que je souhaite passer à la vue.
        $dashboardData = [
            'totalPersonals' => $totalPersonals,
            'newPersonalsThisWeek' => $newPersonalsThisWeek,
            // Je peux ajouter d'autres données nécessaires ici.
        ];

        // Je retourne la vue du tableau de bord, en passant les données préparées.
        return $this->render('admin/dashboard.html.twig', $dashboardData);
    }

    #[Route('/settings', name: 'admin_settings')]

    public function settings(): Response
    {

        // Je récupère les paramètres de configuration actuels.
        // Imaginons que mon application a des paramètres comme 'email_support' et 'maintenance_mode' :
        $emailSupport = $this->configService->get('email_support');
        $maintenanceMode = $this->configService->get('maintenance_mode');

        // Je prépare un tableau associatif avec tous les paramètres de configuration que je souhaite passer à la vue.
        $settings = [
            'emailSupport' => $emailSupport,
            'maintenanceMode' => $maintenanceMode,
            // Je peux ajouter d'autres paramètres de configuration ici.
        ];

        // Je retourne la vue des paramètres de configuration, en passant les paramètres récupérés pour leur affichage et modification.
        return $this->render('admin/settings_manage.html.twig', [
            'settings' => $settings,
        ]);
    }


    // Je peux ajouter ici d'autres méthodes pour gérer les utilisateurs, les équipes, et d'autres fonctionnalités d'administration (A définir).
    #[Route('/performances', name: 'admin_performances', methods: ['GET'])]
    public function managePerformances(PerformanceRepository $performanceRepository): Response
    {
        $performances = $performanceRepository->findAll(); // Récupère toutes les performances

        return $this->render('admin/performances_manage.html.twig', [
            'performances' => $performances,
        ]);
    }

    #[Route('/evaluations', name: 'admin_evaluations', methods: ['GET'])]
    public function manageEvaluations(EvaluationRepository $evaluationRepository): Response
    {
        $evaluations = $evaluationRepository->findAll(); // Récupère toutes les évaluations

        return $this->render('admin/evaluations_manage.html.twig', [
            'evaluations' => $evaluations,
        ]);
    }
}
