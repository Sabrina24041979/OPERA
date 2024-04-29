<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Entity\Team;
use App\Entity\Action;
use App\Entity\Feedback;
use App\Entity\Profile;
use App\Entity\EmployeeSentiments;
use App\Entity\Workload;
use App\Form\GoalType;
use App\Form\TeamType;
use App\Form\ActionType;
use App\Form\FeedbackType;
use App\Form\ProfileType;
use App\Form\EmployeeSentimentsType;
use App\Form\WorkloadType;
use App\Repository\GoalRepository;
use App\Repository\TeamRepository;
use App\Repository\ActionRepository;
use App\Repository\FeedbackRepository;
use App\Repository\EmployeeSentimentsRepository;
use App\Repository\WorkloadRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Doctrine\ORM\EntityManagerInterface;

class ManagerLevel1Controller extends AbstractController
{
    #[Route("/manager/level1/dashboard", name: "manager_level1_dashboard")]
    public function dashboard(): Response
    {
        // Ici, ajoutez une logique pour récupérer des données dynamiques si nécessaire
        return $this->render('manager/level1/dashboard.html.twig');
    }

    // Création de profil collaborateur
    #[Route("/manager/level1/profile/create", name: "manager_level1_create_profile")]
    public function createProfile(Request $request, EntityManagerInterface $entityManager): Response
    {
        $profile = new Profile(); // Supposons que l'entité Profile existe
        $form = $this->createForm(ProfileType::class, $profile); // Assurez-vous que ProfileType est un formulaire Symfony valide
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profile);
            $entityManager->flush();

            $this->addFlash('success', 'Profil créé avec succès.');
            return $this->redirectToRoute('manager_level1_dashboard');
        }

        return $this->render('manager/level1/partials/profile_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Édition d'une équipe
    #[Route("/manager/level1/team/edit/{id}", name: "manager_level1_edit_team")]
    public function editTeam(int $id, Request $request, TeamRepository $teamRepository, EntityManagerInterface $entityManager): Response
    {
        $team = $teamRepository->find($id);
        if (!$team) {
            throw $this->createNotFoundException('Équipe non trouvée.');
        }

        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Équipe mise à jour avec succès.');
            return $this->redirectToRoute('manager_level1_dashboard');
        }

        return $this->render('manager/level1/partials/team_form.html.twig', [
            'form' => $form->createView(),
            'team_id' => $id
        ]);
    }

    // Création d'un objectif
    #[Route("/manager/level1/goal/create", name: "manager_level1_create_goal")]
    public function createGoal(Request $request, EntityManagerInterface $entityManager): Response
    {
        $goal = new Goal();
        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($goal);
            $entityManager->flush();

            $this->addFlash('success', 'Objectif créé avec succès.');
            return $this->redirectToRoute('manager_level1_dashboard');
        }

        return $this->render('manager/level1/partials/goal_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Édition d'un objectif
    #[Route("/manager/level1/goal/edit/{id}", name: "manager_level1_edit_goal")]
    public function editGoal(int $id, Request $request, GoalRepository $goalRepository, EntityManagerInterface $entityManager): Response
    {
        $goal = $goalRepository->find($id);
        if (!$goal) {
            throw $this->createNotFoundException('Objectif non trouvé.');
        }

        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Objectif mis à jour avec succès.');
            return $this->redirectToRoute('manager_level1_dashboard');
        }

        return $this->render('manager/level1/partials/goal_form.html.twig', [
            'form' => $form->createView(),
            'goal_id' => $id
        ]);
    }

    // Création d'une action
    #[Route("/manager/level1/action/create", name: "manager_level1_create_action")]
    public function createAction(Request $request, EntityManagerInterface $entityManager): Response
    {
        $action = new Action();
        $form = $this->createForm(ActionType::class, $action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($action);
            $entityManager->flush();

            $this->addFlash('success', 'Action créée avec succès.');
            return $this->redirectToRoute('manager_level1_dashboard');
        }

        return $this->render('manager/level1/partials/actions_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Édition d'une action
    #[Route("/manager/level1/action/edit/{id}", name: "manager_level1_edit_action")]
    public function editAction(int $id, Request $request, ActionRepository $actionRepository, EntityManagerInterface $entityManager): Response
    {
        $action = $actionRepository->find($id);
        if (!$action) {
            throw $this->createNotFoundException('Action non trouvée.');
        }

        $form = $this->createForm(ActionType::class, $action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Action mise à jour avec succès.');
            return $this->redirectToRoute('manager_level1_dashboard');
        }

        return $this->render('manager/level1/partials/actions_form.html.twig', [
            'form' => $form->createView(),
            'action_id' => $id
        ]);
    }

    #[Route("/manager/level1/feedback/create", name: "manager_level1_create_feedback")]
    public function createFeedback(Request $request, EntityManagerInterface $entityManager): Response
    {
        $feedback = new Feedback();
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feedback);
            $entityManager->flush();

            $this->addFlash('success', 'Feedback créé avec succès.');
            return $this->redirectToRoute('manager_level1_dashboard');
        }

        return $this->render('manager/level1/partials/feedback_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route("/manager/level1/feedback/edit/{id}", name: "manager_level1_edit_feedback")]
    public function editFeedback(int $id, Request $request, FeedbackRepository $feedbackRepository, EntityManagerInterface $entityManager): Response
    {
        $feedback = $feedbackRepository->find($id);
        if (!$feedback) {
            throw $this->createNotFoundException('Feedback non trouvé.');
        }

        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Feedback mis à jour avec succès.');
            return $this->redirectToRoute('manager_level1_dashboard');
        }

        return $this->render('manager/level1/partials/feedback_form.html.twig', [
            'form' => $form->createView(),
            'feedback_id' => $id
        ]);
    }

    #[Route("/manager/level1/sentiments/create", name: "manager_level1_create_sentiments")]
    public function createSentiments(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sentiment = new EmployeeSentiments();
        $form = $this->createForm(EmployeeSentimentsType::class, $sentiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sentiment);
            $entityManager->flush();

            $this->addFlash('success', 'Sentiment enregistré avec succès.');
            return $this->redirectToRoute('manager_level1_dashboard');
        }

        return $this->render('manager/level1/partials/sentiments_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route("/manager/level1/sentiments/edit/{id}", name: "manager_level1_edit_sentiments")]
    public function editSentiments(int $id, Request $request, EmployeeSentimentsRepository $sentimentsRepository, EntityManagerInterface $entityManager): Response
    {
        $sentiment = $sentimentsRepository->find($id);
        if (!$sentiment) {
            throw $this->createNotFoundException('Sentiment non trouvé.');
        }

        $form = $this->createForm(EmployeeSentimentsType::class, $sentiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Sentiment mis à jour avec succès.');
            return $this->redirectToRoute('manager_level1_dashboard');
        }

        return $this->render('manager/level1/partials/sentiments_form.html.twig', [
            'form' => $form->createView(),
            'sentiment_id' => $id
        ]);
    }

    #[Route("/manager/level1/workload/create", name: "manager_level1_create_workload")]
    public function createWorkload(Request $request, EntityManagerInterface $entityManager): Response
    {
        $workload = new Workload();
        $form = $this->createForm(WorkloadType::class, $workload, );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($workload);
            $entityManager->flush();

            $this->addFlash('success', 'Charge de travail enregistrée avec succès.');
            return $this->redirectToRoute('manager_level1_dashboard');
        }

        return $this->render('manager/level1/partials/workload_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route("/manager/level1/workload/edit/{id}", name: "manager_level1_edit_workload")]
    public function editWorkload(int $id, Request $request, WorkloadRepository $workloadRepository, EntityManagerInterface $entityManager): Response
    {
        $workload = $workloadRepository->find($id);
        if (!$workload) {
            throw $this->createNotFoundException('Charge de travail non trouvée.');
        }

        $form = $this->createForm(WorkloadType::class, $workload);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Charge de travail mise à jour avec succès.');
            return $this->redirectToRoute('manager_level1_dashboard');
        }

        return $this->render('manager/level1/partials/workload_form.html.twig', [
            'form' => $form->createView(),
            'workload_id' => $id
        ]);
    }

}
