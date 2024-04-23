<?php

namespace App\Controller;

use App\Entity\SystemLog;
use App\Form\SystemLogType;
use App\Repository\SystemLogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/system/log')]
class SystemLogController extends AbstractController
{
    #[Route('/', name: 'system_log_index', methods: ['GET'])]
    public function index(SystemLogRepository $logRepository): Response
    {
        $logs = $logRepository->findAll();
        return $this->render('system_log/index.html.twig', ['logs' => $logs]);
    }

    #[Route('/new', name: 'system_log_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $systemLog = new SystemLog();
        $systemLog->setCreatedAt(new \DateTime()); // Set the current date by default
        $form = $this->createForm(SystemLogType::class, $systemLog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($systemLog);
            $entityManager->flush();

            return $this->redirectToRoute('system_log_index');
        }

        return $this->render('system_log/new.html.twig', [
            'systemLog' => $systemLog,
            'form' => $form->createView(),
        ]);
    }
}
