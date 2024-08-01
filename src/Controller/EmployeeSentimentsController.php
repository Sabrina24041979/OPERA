<?php

namespace App\Controller;

use App\Entity\EmployeeSentiments;
use App\Form\EmployeeSentimentsType;
use App\Repository\EmployeeSentimentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/employee/sentiments')]
#[IsGranted('ROLE_MANAGER')]
class EmployeeSentimentsController extends AbstractController
{
    // Je définis la route pour l'index des sentiments des employés.
    #[Route('', name: 'app_employee_sentiments_index', methods: ['GET'])]
    public function index(EmployeeSentimentsRepository $employeeSentimentsRepository): Response
    {
        // Je vérifie si l'utilisateur a le rôle de manager pour accéder à cette page.
        // $this->denyAccessUnlessGranted('ROLE_MANAGER');

        $userId = $this->getUser()->getId();

        // Je récupère les sentiments liés au manager connecté. Cette méthode doit être implémentée dans le repository.
        $employeeSentiments = $employeeSentimentsRepository->findAllByManager($userId);

        return $this->render('employee_sentiments/index.html.twig', [
            'employee_sentiments' => $employeeSentiments,
        ]);
    }

    // Je définis la route pour créer un nouveau sentiment.
    #[Route('/new', name: 'app_employee_sentiments_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response|RedirectResponse
    {
        $employeeSentiment = new EmployeeSentiments;
        $form = $this->createForm(EmployeeSentimentsType::class, $employeeSentiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employeeSentiment->setPersonal($this->getUser());

            $entityManager->persist($employeeSentiment);
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_sentiments_index');
        }
        return $this->render('employee_sentiments/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Je définis la route pour afficher un sentiment spécifique.
    #[Route('/{id}', name: 'app_employee_sentiments_show', methods: ['GET'])]
    public function show(EmployeeSentiments $employeeSentiment): Response
    {
        // Je vérifie si l'utilisateur a le droit de voir cet enregistrement.
        // $this->denyAccessUnlessGranted('view', $employeeSentiment);

        return $this->render('employee_sentiments/show.html.twig', [
            'employee_sentiment' => $employeeSentiment,
        ]);
    }

    // Je définis la route pour éditer un sentiment existant.
    #[Route('/{id}/edit', name: 'app_employee_sentiments_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EmployeeSentiments $employeeSentiment, EntityManagerInterface $entityManager): Response
    {
        // Je vérifie les droits d'édition sur cet enregistrement.
        // $this->denyAccessUnlessGranted('edit', $employeeSentiment);

        $form = $this->createForm(EmployeeSentimentsType::class, $employeeSentiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_sentiments_index');
        }

        return $this->render('employee_sentiments/edit.html.twig', [
            'employee_sentiment' => $employeeSentiment,
            'form' => $form->createView(),
        ]);
    }

    // Je définis la route pour supprimer un sentiment.
    #[Route('/{id}', name: 'app_employee_sentiments_delete', methods: ['POST'])]
    public function delete(Request $request, EmployeeSentiments $employeeSentiment, EntityManagerInterface $entityManager): Response
    {
        // Je vérifie si l'utilisateur a le droit de supprimer cet enregistrement.
        // $this->denyAccessUnlessGranted('delete', $employeeSentiment);

        if ($this->isCsrfTokenValid('delete' . $employeeSentiment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($employeeSentiment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_employee_sentiments_index');
    }
}
