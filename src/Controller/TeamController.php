<?php

namespace App\Controller;

use App\Entity\Team;
use App\Form\TeamType;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/team')]
class TeamController extends AbstractController
{
    // J'affiche la liste de toutes les équipes.
    #[Route('/', name: 'app_team_index', methods: ['GET'])]
    public function index(TeamRepository $teamRepository): Response
    {
        // Je récupère toutes les équipes via le repository et les transmets à la vue.
        return $this->render('team/index.html.twig', [
            'teams' => $teamRepository->findAll(),
        ]);
    }

    // Je crée une nouvelle équipe.
    #[Route('/new', name: 'app_team_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $team = new Team();
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($team);
            $entityManager->flush();

            // Après la création, je redirige l'utilisateur vers la liste des équipes.
            return $this->redirectToRoute('app_team_index', [], Response::HTTP_SEE_OTHER);
        }

        // J'affiche le formulaire de création d'une nouvelle équipe.
        return $this->render('team/new.html.twig', [
            'team' => $team,
            'form' => $form->createView(), // J'utilise createView() pour passer le formulaire à la vue.
        ]);
    }

    // Je montre les détails d'une équipe spécifique.
    #[Route('/{id}', name: 'app_team_show', methods: ['GET'])]
    public function show(Team $team): Response
    {
        // Je transmets les détails de l'équipe spécifiée à la vue.
        return $this->render('team/show.html.twig', [
            'team' => $team,
        ]);
    }

    // J'édite une équipe existante.
    #[Route('/{id}/edit', name: 'app_team_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Team $team, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // Après l'édition, je redirige l'utilisateur vers la liste des équipes.
            return $this->redirectToRoute('app_team_index', [], Response::HTTP_SEE_OTHER);
        }

        // J'affiche le formulaire d'édition d'une équipe.
        return $this->render('team/edit.html.twig', [
            'team' => $team,
            'form' => $form->createView(),
        ]);
    }

    // Je supprime une équipe.
    #[Route('/{id}', name: 'app_team_delete', methods: ['POST'])]
    public function delete(Request $request, Team $team, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$team->getId(), $request->request->get('_token'))) {
            $entityManager->remove($team);
            $entityManager->flush();
        }

        // Après la suppression, je redirige l'utilisateur vers la liste des équipes.
        return $this->redirectToRoute('app_team_index', [], Response::HTTP_SEE_OTHER);
    }
}
