<?php

namespace App\Controller;

use App\Entity\PerformanceReview;
use App\Form\PerformanceReviewType;
use App\Repository\PerformanceReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/performance-review')]
class PerformanceReviewsController extends AbstractController
{
    #[Route('/', name: 'performance_review_index', methods: ['GET'])]
    public function index(PerformanceReviewRepository $performanceReviewRepository): Response
    {
        return $this->render('performance_review/index.html.twig', [
            // 'performance_reviews' => $repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'performance_review_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $performanceReview = new PerformanceReview();
        $form = $this->createForm(PerformanceReviewType::class, $performanceReview);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($performanceReview);
            $entityManager->flush();

            return $this->redirectToRoute('performance_review_index');
        }

        return $this->render('performance_review/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Ajoutez d'autres méthodes selon vos besoins...
}
