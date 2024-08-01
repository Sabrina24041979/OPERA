<?php

namespace App\Controller;

use App\Entity\TypeInterview;
use App\Form\TypeInterviewType;
use App\Repository\TypeInterviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/type/interview', name: 'app_')]
class TypeInterviewController extends AbstractController
{
    #[Route('/', name: 'type_interview_index', methods: ['GET'])]
    public function index(TypeInterviewRepository $typeInterviewRepository): Response
    {
        return $this->render('type_interview/index.html.twig', [
            'type_interviews' => $typeInterviewRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'type_interview_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeInterview = new TypeInterview();
        $form = $this->createForm(TypeInterviewType::class, $typeInterview);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeInterview);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_interview_index');
        }

        return $this->render('type_interview/new.html.twig', [
            'type_interview' => $typeInterview,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'type_interview_show', methods: ['GET'])]
    public function show(TypeInterview $typeInterview): Response
    {
        return $this->render('type_interview/show.html.twig', [
            'type_interview' => $typeInterview,
        ]);
    }

    #[Route('/{id}/edit', name: 'type_interview_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeInterview $typeInterview, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeInterviewType::class, $typeInterview);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_interview_index');
        }

        return $this->render('type_interview/edit.html.twig', [
            'type_interview' => $typeInterview,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'type_interview_delete', methods: ['POST'])]
    public function delete(Request $request, TypeInterview $typeInterview, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $typeInterview->getId(), $request->request->get('_token'))) {
            $entityManager->remove($typeInterview);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_interview_index');
    }
}
