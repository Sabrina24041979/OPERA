<?php

namespace App\Controller;

use App\Entity\Interview;
use App\Form\InterviewType;
use App\Repository\InterviewRepository;
use App\Repository\TypeInterviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/interview')]
class InterviewController extends AbstractController
{
    // Route pour afficher tous les entretiens
    #[Route("/", name: "app_interview_index", methods: ["GET"])]
    public function index(InterviewRepository $interviewRepository): Response
    {
        $interviews = $interviewRepository->findAll();

        return $this->render('interview/index.html.twig', [
            'interviews' => $interviews,
        ]);
    }

    // Route pour afficher les entretiens par manager (ajustement du nom de méthode)
    #[Route('/manager/{id}', name: 'app_interview_manager_index', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function listByManager(int $id, InterviewRepository $interviewRepository): Response
    {
        $interviews = [];
        if ($this->isGranted('ROLE_MANAGER')) {
            $interviews = $interviewRepository->findAllByManager($id);
        }
        if ($this->isGranted('ROLE_USER')) {
            $interviews = $interviewRepository->findAllByCollaborator($id);
        }

        return $this->render('interview/index.html.twig', [
            'interviews' => $interviews,
        ]);
    }

    #[Route('/new', name: 'app_interview_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $interview = new Interview();
        $form = $this->createForm(InterviewType::class, $interview);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $interview->setInterviewer($this->getUser());
            $interview->setStatus('Planifié');
            // dd($interview);
            $entityManager->persist($interview);
            $entityManager->flush();

            // Redirection à la page de confirmation ou au tableau de bord de l'utilisateur
            return $this->redirectToRoute('app_interview_manager_index', ['id' => $this->getUser()->getId()]);
        }

        return $this->render('interview/new.html.twig', [
            'interview' => $interview,
            'form' => $form->createView(),
        ]);
    }



    #[Route('/{id}', name: 'app_interview_show', methods: ['GET'])]
    public function show(Interview $interview): Response
    {
        // dd($interview);
        return $this->render('interview/show.html.twig', [
            'interview' => $interview,
        ]);
    }

    #[Route('/details/{id}', name: 'app_interview_modal_details', methods: ['GET'])]
    public function modalDetails(?Interview $interview): JsonResponse
    {
        //avec param converter, on récupère l'interview avec id passé en url

        //si il trouve pas l'interview par son id, renvoie code erreur 404 en console
        if (!$interview) {
            return $this->json(['error' => 'Interview not found'], 404);
        }


        //envoie des données demandées dans calendar.js
        return new JsonResponse([
            'name' => $interview->getTypeInterview()->getName(),
            'username' => $interview->getInterviewee()->getUsername(),
            'date' => $interview->getDate()->format('Y-m-d H:i:s'),
            'duration' => $interview->getTypeInterview()->getDuration(),
            'status' => $interview->getStatus(),
        ], 200);
    }

    #[Route('/{id}/edit', name: 'app_interview_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Interview $interview, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InterviewType::class, $interview);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_interview_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('interview/edit.html.twig', [
            'interview' => $interview,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_interview_delete', methods: ['POST'])]
    public function delete(Security $security, Request $request, Interview $interview, EntityManagerInterface $entityManager): Response
    {
        $user = $security->getUser();
        $idManager = $user->getId();
        // dd($idmanager);
        if ($this->isCsrfTokenValid('delete' . $interview->getId(), $request->request->get('_token'))) {
            $entityManager->remove($interview);
            $entityManager->flush();
            $this->addFlash('error', 'Entretien supprimé.');
        }

        return $this->redirectToRoute('app_interview_manager_index', ['id' => $idManager]);
    }

    #[Route('/manager/planning', name: 'manager_planning')]
    public function planning(InterviewRepository $interviewRepository, TypeInterviewRepository $typeInterview): Response
    {
        $this->denyAccessUnlessGranted('ROLE_MANAGER');
        // $manager = $this->getUser(); 
        $manager = $this->getUser();

        // Supposons que vous avez une méthode pour récupérer les entretiens par manager
        $interviews = $interviewRepository->findBy(['interviewer' => $manager]);

        // dd($interviews);
        //$interviews est un tableau contenant tous les entretiens en bdd avec date, status, manager, colab, type

        // initialzing empty array where all interviews will be pushed in FullCalendar Format as json
        $events = [];

        //loop to get all interviews from database
        foreach ($interviews as $interview) {
            $events[] = [
                'id' => $interview->getId(),
                'start' => $interview->getDate()->format('Y-m-d H:i:s'),
                'end' => $interview->getEndDate()->format('Y-m-d H:i:s'),
                'title' => 'Avec ' . $interview->getInterviewee()->getUsername(),
                'status' => $interview->getStatus(),
                'description' => 'Description',
                'backgroundColor' => $interview->getTypeInterview()->getBackgroundColor(),
                'textColor' => '#000000'
            ];
        }

        //give data as array with php fct compact()
        return $this->render(
            'manager/level1/planning.html.twig',
            [
                'events' => json_encode($events),
                'typeInterview' => $typeInterview->findAll(),
            ]
        );
    }
}
