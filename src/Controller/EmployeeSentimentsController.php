<?php

namespace App\Controller;

use App\Entity\EmployeeSentiments;
use App\Form\EmployeeSentimentsType;
use App\Repository\EmployeeSentimentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/employee/sentiments')]
class EmployeeSentimentsController extends AbstractController
{
    #[Route('/', name: 'app_employee_sentiments_index', methods: ['GET'])]
    public function index(EmployeeSentimentsRepository $employeeSentimentsRepository): Response
    {
        return $this->render('employee_sentiments/index.html.twig', [
            'employee_sentiments' => $employeeSentimentsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_employee_sentiments_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $employeeSentiment = new EmployeeSentiments();
        $form = $this->createForm(EmployeeSentimentsType::class, $employeeSentiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($employeeSentiment);
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_sentiments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('employee_sentiments/new.html.twig', [
            'employee_sentiment' => $employeeSentiment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employee_sentiments_show', methods: ['GET'])]
    public function show(EmployeeSentiments $employeeSentiment): Response
    {
        return $this->render('employee_sentiments/show.html.twig', [
            'employee_sentiment' => $employeeSentiment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_employee_sentiments_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EmployeeSentiments $employeeSentiment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EmployeeSentimentsType::class, $employeeSentiment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_sentiments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('employee_sentiments/edit.html.twig', [
            'employee_sentiment' => $employeeSentiment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employee_sentiments_delete', methods: ['POST'])]
    public function delete(Request $request, EmployeeSentiments $employeeSentiment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employeeSentiment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($employeeSentiment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_employee_sentiments_index', [], Response::HTTP_SEE_OTHER);
    }
}
