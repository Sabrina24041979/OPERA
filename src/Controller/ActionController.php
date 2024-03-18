<?php

namespace App\Controller;

use App\Entity\Action;
use App\Form\ActionType;
use App\Repository\ActionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/action')]
class ActionController extends AbstractController
{
    #[Route('/', name: 'app_action_index', methods: ['GET'])]
    public function index(ActionRepository $actionRepository): Response
    {
        return $this->render('action/index.html.twig', [
            'actions' => $actionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_action_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $action = new Action();
        $form = $this->createForm(ActionType::class, $action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($action);
            $entityManager->flush();

            return $this->redirectToRoute('app_action_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('action/new.html.twig', [
            'action' => $action,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_action_show', methods: ['GET'])]
    public function show(Action $action): Response
    {
        return $this->render('action/show.html.twig', [
            'action' => $action,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_action_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Action $action, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ActionType::class, $action);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_action_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('action/edit.html.twig', [
            'action' => $action,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_action_delete', methods: ['POST'])]
    public function delete(Request $request, Action $action, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$action->getId(), $request->request->get('_token'))) {
            $entityManager->remove($action);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_action_index', [], Response::HTTP_SEE_OTHER);
    }
}
