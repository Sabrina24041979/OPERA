<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Form\GoalType;
use App\Repository\GoalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/goal')]
class GoalController extends AbstractController
{
    // Méthode pour lister tous les objectifs
    #[Route('/', name: 'app_goal_index', methods: ['GET'])]
    public function index(GoalRepository $goalRepository): Response
    {
        // Je récupère tous les objectifs grâce au repository et je les passe à la vue
        return $this->render('goal/index.html.twig', [
            'goals' => $goalRepository->findAll(),
        ]);
    }

    // Méthode pour créer un nouvel objectif
    #[Route('/new', name: 'app_goal_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $goal = new Goal();
        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($goal);
            $entityManager->flush();

            // Redirection vers la liste des objectifs après création
            return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
        }

        // Rendu du formulaire de création d'un objectif
        return $this->render('goal/new.html.twig', [
            'goal' => $goal,
            'form' => $form->createView(), // Correction : utilisez createView() pour passer le formulaire à la vue
        ]);
    }

    // Méthode pour afficher les détails d'un objectif
    #[Route('/{id}', name: 'app_goal_show', methods: ['GET'])]
    public function show(Goal $goal): Response
    {
        // Affichage des détails d'un objectif spécifique
        return $this->render('goal/show.html.twig', [
            'goal' => $goal,
        ]);
    }

    // Méthode pour éditer un objectif existant
    #[Route('/{id}/edit', name: 'app_goal_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Goal $goal, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // Redirection vers la liste des objectifs après édition
            return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
        }

        // Rendu du formulaire d'édition d'un objectif
        return $this->render('goal/edit.html.twig', [
            'goal' => $goal,
            'form' => $form->createView(),
        ]);
    }

    // Méthode pour supprimer un objectif
    #[Route('/{id}', name: 'app_goal_delete', methods: ['POST'])]
    public function delete(Request $request, Goal $goal, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$goal->getId(), $request->request->get('_token'))) {
            $entityManager->remove($goal);
            $entityManager->flush();
        }

        // Redirection vers la liste des objectifs après suppression
        return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
    }
}
