<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Form\GoalType;
use App\Entity\Interview;
use App\Repository\GoalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

#[Route('/goal')]
class GoalController extends AbstractController
{
    #[Route('/', name: 'app_goal_index', methods: ['GET'])]
    public function index(GoalRepository $goalRepository): Response
    {
        // S'assurer que l'utilisateur a le droit de voir la liste des objectifs
        // $this->denyAccessUnlessGranted('ROLE_MANAGER');

        return $this->render('goal/index.html.twig', [
            'goals' => $goalRepository->findAll(),
        ]);
    }

    #[Route('/manager/{id}', name: 'app_goal_manager_index', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function listByManager(int $id, GoalRepository $goalRepository): Response 
    {
        $goals=[];
        if ($this->isGranted('ROLE_MANAGER')){
            $interviews = $goalRepository->findAllByManager($id);
        }
        if ($this->isGranted('ROLE_USER')){
            $interviews = $goalRepository->findAllByCollaborator($id);
        }

        return $this->render('goal/index.html.twig', [
            'goals' => $goals,
        ]);
    }


    #[Route('/new', name: 'app_goal_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {             
        $goal = new Goal();
        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $interview = $entityManager->getRepository(Interview::class)->find((int)$request->query->get('interviewId'));
            $goal->setInterview($interview);
            $interview->addGoal($goal);
            $goal->setPersonal($this->getUser());
            $goal->setStatus('En cours');

            $entityManager->persist($goal);
            $entityManager->flush();
            // $this->addFlash('success', 'Objectif créé avec succès.');

            return $this->redirectToRoute('app_interview_show', ['id' => $goal->getInterview()->getId()]);
        }

        return $this->render('goal/new.html.twig', [
            'goal' => $goal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_goal_show', methods: ['GET'])]
    public function show(Goal $goal): Response
    {
        // // Vérification des droits d'accès pour la consultation
        // $this->denyAccessUnlessGranted('view', $goal);

        return $this->render('goal/show.html.twig', [
            'goal' => $goal,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_goal_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Goal $goal, EntityManagerInterface $entityManager): Response
    {
        // Vérification des droits d'accès pour l'édition
        // $this->denyAccessUnlessGranted('edit', $goal);

        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            // $this->addFlash('success', 'Objectif mis à jour avec succès.');

            return $this->redirectToRoute('app_goal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('goal/edit.html.twig', [
            'goal' => $goal,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_goal_delete', methods: ['POST'])]
    public function delete(Security $security,Request $request, Goal $goal, EntityManagerInterface $entityManager): Response
    {
        // Vérification des droits d'accès pour la suppression
        // $this->denyAccessUnlessGranted('delete', $goal);
        $user=$security->getUser();
        $idManager=$user->getId();

        if ($this->isCsrfTokenValid('delete'.$goal->getId(), $request->request->get('_token'))) {
            $entityManager->remove($goal);
            $entityManager->flush();
            $this->addFlash('error', 'Objectif supprimé.');           
        }

        // Si le token CSRF n'est pas valide, rediriger vers l'index
        return $this->redirectToRoute('app_goal_index', ['id' => $idManager]);
    }

    #[Route("/manager/goals", name:"manager_goals")]
     
    public function listForManager(GoalRepository $goalRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_MANAGER');

        $goals = $goalRepository->findAll();  // Vous pouvez adapter cette méthode pour filtrer les objectifs selon les besoins

        return $this->render('goal/manager_index.html.twig', [
            'goals' => $goals,
        ]);
    }
}
