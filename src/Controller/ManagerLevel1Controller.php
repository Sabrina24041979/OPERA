<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManagerLevel1Controller extends AbstractController
{
    
    /* Je gère l'affichage du tableau de bord du manager de niveau 1.*/
    #[Route("/manager/level1/dashboard", name:"manager_level1_dashboard")]

    public function dashboard(): Response
    {
        // Je pourrais récupérer les données nécessaires à partir des services ou directement de la base de données
        // Exemple: récupérer la liste des équipes, les objectifs récents, etc.
        return $this->render('manager/level1/dashboard.html.twig', [
            // Je passe les données nécessaires à la vue
        ]);
    }

    /**
     * Je gère la création d'un profil de collaborateur.*/
    #[Route("/manager/level1/profile/create", name:"manager_level1_create_profile")]

    public function createProfile(): Response
    {
        // Logique pour la création d'un profil

        return $this->render('manager/level1/partials/profile_form.html.twig', [
            // Je passe les paramètres nécessaires au formulaire
        ]);
    }

    /**
     * Je gère l'édition d'une équipe.*/
    #[Route("/manager/level1/team/edit/{id}", name:"manager_level1_edit_team")]
     
    public function editTeam(int $id): Response
    {
        // Logique pour récupérer les détails de l'équipe et les passer au formulaire

        return $this->render('manager/level1/partials/team_form.html.twig', [
            'team_id' => $id
            // Autres paramètres si nécessaire
        ]);
    }

    
    /* Je gère la création d'un objectif.*/
    #[Route("/manager/level1/objective/create", name:"manager_level1_create_objective")]
    
    public function createObjective(): Response
    {
        // Logique pour la création d'un objectif

        return $this->render('manager/level1/partials/objectives_form.html.twig', [
            // Je passe les paramètres nécessaires au formulaire
        ]);
    }

    
    /* Je gère l'édition d'un objectif.*/
    #[Route("/manager/level1/objective/edit/{id}", name:"manager_level1_edit_objective")]

    public function editObjective(int $id): Response
    {
        // Logique pour récupérer les détails de l'objectif et les passer au formulaire

        return $this->render('manager/level1/partials/objectives_form.html.twig', [
            'objective_id' => $id
            // Autres paramètres si nécessaire
        ]);
    }

    
    /* Je gère la création d'une action liée à un objectif.*/
    #[Route("/manager/level1/action/create", name:"manager_level1_create_action")]
    
    public function createAction(): Response
    {
        // Logique pour la création d'une action

        return $this->render('manager/level1/partials/actions_form.html.twig', [
            // Je passe les paramètres nécessaires au formulaire
        ]);
    }

    
    /* Je gère l'édition d'une action.*/
    #[Route("/manager/level1/action/edit/{id}", name:"manager_level1_edit_action")]
    
    public function editAction(int $id): Response
    {
        // Logique pour récupérer les détails de l'action et les passer au formulaire

        return $this->render('manager/level1/partials/actions_form.html.twig', [
            'action_id' => $id
            // Autres paramètres si nécessaire
        ]);
    }

    
     /*Je gère la création d'un feedback suite à un entretien ou à une évaluation.*/
    #[Route("/manager/level1/feedback/create", name:"manager_level1_create_feedback")]
    
    public function createFeedback(): Response
    {
        // Logique pour la création d'un feedback

        return $this->render('manager/level1/partials/feedback_form.html.twig', [
            // Je passe les paramètres nécessaires au formulaire
        ]);
    }

    #[Route("/manager/level1/feedback/edit/{id}", name:"manager_level1_edit_feedback")]
    public function editFeedback(int $id, FeedbackRepository $feedbackRepository): Response
    {
        // Je récupère le feedback par son ID via le repository
        $feedback = $feedbackRepository->find($id);

        if (!$feedback) {
            // Je gère le cas où le feedback n'est pas trouvé
            throw $this->createNotFoundException('Le feedback demandé n\'existe pas.');
        }

        // Je récupère les détails du collaborateur liés au feedback
        $collaborator = $feedback->getCollaborator();

        // Je prépare des données additionnelles pour la vue si nécessaire
        $contextData = [
            'collaboratorName' => $collaborator->getName(),
            'collaboratorRole' => $collaborator->getRole(),
            'feedbackDate' => $feedback->getDate()->format('Y-m-d'),
            'feedbackContent' => $feedback->getContent()
        ];

        return $this->render('manager/level1/partials/feedback_form.html.twig', [
            'feedback_id' => $id,
            'feedbackData' => $feedback,
            'contextData' => $contextData  // Je passe les données contextuelles à la vue
        ]);
    }

}

