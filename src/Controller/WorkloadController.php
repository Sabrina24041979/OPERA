<?php

namespace App\Controller;

use App\Entity\Workload;
use App\Form\WorkloadType;
use App\Repository\WorkloadRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/workload')]
#[IsGranted('ROLE_MANAGER')]
class WorkloadController extends AbstractController
{
    #[Route('/', name: 'app_workload_index', methods: ['GET'])]
    public function index(WorkloadRepository $workloadRepository): Response
    {
        $employeeId = $this->getUser()->getId();

        return $this->render('workload/index.html.twig', [
            'workloads' => $workloadRepository->findAllByManager($employeeId),
        ]);
    }

    #[Route('/new', name: 'app_workload_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $workload = new Workload();
        $form = $this->createForm(WorkloadType::class, $workload);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workload->setPersonal($this->getUser());

            $entityManager->persist($workload);
            $entityManager->flush();

            return $this->redirectToRoute('app_workload_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('workload/new.html.twig', [
            'workload' => $workload,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_workload_show', methods: ['GET'])]
    public function show(Workload $workload): Response
    {
        return $this->render('workload/show.html.twig', [
            'workload' => $workload,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_workload_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Workload $workload, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WorkloadType::class, $workload);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_workload_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('workload/edit.html.twig', [
            'workload' => $workload,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_workload_delete', methods: ['POST'])]
    public function delete(Request $request, Workload $workload, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $workload->getId(), $request->request->get('_token'))) {
            $entityManager->remove($workload);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_workload_index', [], Response::HTTP_SEE_OTHER);
    }
}
