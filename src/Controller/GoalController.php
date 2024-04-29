<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Form\GoalType;
use App\Repository\GoalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

#[Route('/goal')]
class GoalController extends AbstractController
{
    #[Route('/', name: 'app_goal_index', methods: ['GET'])]
    public function index(GoalRepository $goalRepository): Response
    {
        // S'assurer que l'utilisateur a le droit de voir la liste des objectifs
        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('goal/index.html.twig', [
            'goals' => $goalRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_goal_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // S'assurer que l'utilisateur a le droit de créer un objectif
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $goal = new Goal();
        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($goal);
            $entityManager->flush();
            $this->addFlash('success', 'Objectif créé avec succès.');

            return $this->redirectToRoute('app_goal_index');
        }

        return $this->render('goal/new.html.twig', [
            'goal' => $goal,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_goal_show', methods: ['GET'])]
    public function show(Goal $goal): Response
    {
        // Vérification des droits d'accès pour la consultation
        $this->denyAccessUnlessGranted('view', $goal);

        return $this->render('goal/show.html.twig', [
            'goal' => $goal,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_goal_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Goal $goal, EntityManagerInterface $entityManager): Response
    {
        // Vérification des droits d'accès pour l'édition
        $this->denyAccessUnlessGranted('edit', $goal);

        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Objectif mis à jour avec succès.');

            return $this->redirectToRoute('app_goal_index');
        }

        return $this->render('goal/edit.html.twig', [
            'goal' => $goal,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_goal_delete', methods: ['POST'])]
    public function delete(Request $request, Goal $goal, EntityManagerInterface $entityManager): Response
    {
        // Vérification des droits d'accès pour la suppression
        $this->denyAccessUnlessGranted('delete', $goal);

        if ($this->isCsrfTokenValid('delete'.$goal->getId(), $request->request->get('_token'))) {
            $entityManager->remove($goal);
            $entityManager->flush();
            $this->addFlash('error', 'Objectif supprimé.');

            return $this->redirectToRoute('app_goal_index');
        }

        // Si le token CSRF n'est pas valide, rediriger vers l'index
        return $this->redirectToRoute('app_goal_index');
    }
}
