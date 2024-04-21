<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemoController extends AbstractController
{
    #[Route("/demo-request", name:"demo_request")]
    public function demoRequest(): Response
    {
        // Simuler la préparation de données pour la démonstration
        $demoData = [
            'performanceTools' => 'Analysez en profondeur les performances de vos équipes à travers des tableaux de bord interactifs.',
            'goalSetting' => 'Définissez et suivez les objectifs de manière claire et cohérente, avec des indicateurs précis pour chaque collaborateur.',
            'feedbackMechanism' => 'Utilisez un système de feedback continu pour améliorer le dialogue entre managers et employés.',
            'resourceAccess' => 'Accédez à une bibliothèque de ressources pour le développement des compétences managériales et techniques.',
            'supportDetails' => 'Bénéficiez d\’une assistance dédiée pour faciliter l\’intégration et l\’utilisation d\’OPERA au quotidien.'
        ];

        // Préparation des points forts à mettre en avant durant la démo
        $highlights = [
            'Quick Deployment' => 'Déploiement rapide sans perturber les opérations courantes.',
            'Cost Effective' => 'Un coût nettement inférieur à celui des formations traditionnelles et des outils de gestion séparés.',
            'Customizable' => 'Personnalisation selon les besoins spécifiques de votre organisation.',
            'User Friendly' => 'Interface intuitive qui simplifie la gestion quotidienne.'
        ];

        // Retourner une vue avec les données préparées
        return $this->render('demo/demo_request.html.twig', [
            'demoData' => $demoData,
            'highlights' => $highlights
        ]);
    }
}
