<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatisticsController extends AbstractController
{
    #[Route("/statistics", name:"statistics_index")]
    
    public function index(): Response
    {
        // Imaginons que vous calculiez ou récupériez ces données depuis votre base de données ou un service
        $totalInterviews = 10;  // Nombre total d'entretiens
        $goalsCompleted = 5;    // Objectifs atteints ce mois
        $satisfactionRate = 95; // Taux de satisfaction en pourcentage

        return $this->render('components/statistics_widget.twig', [
            'total_interviews' => $totalInterviews,
            'goals_completed' => $goalsCompleted,
            'satisfaction_rate' => $satisfactionRate,
        ]);
    }

    /**
     * @Route("/statistics/details", name="statistics_details")
     */
    public function showStatistics(): Response
    {
        // Simulez la récupération des données ou récupérez-les depuis votre base de données.
        $totalInterviews = 10;  // Nombre total d'entretiens
        $goalsCompleted = 5;    // Objectifs atteints ce mois
        $satisfactionRate = 90; // Taux de satisfaction en pourcentage

        return $this->render('components/statistics_widget.twig', [
            'total_interviews' => $totalInterviews,
            'goals_completed' => $goalsCompleted,
            'satisfaction_rate' => $satisfactionRate,
        ]);
    }
}
