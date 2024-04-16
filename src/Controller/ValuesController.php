<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ValuesController extends AbstractController
{
    #[Route("/values", name:"values_index")]
    public function index(): Response
    {
        // Je simule des données pour l'exemple
        $values = [
            ['title' => 'Innovation', 'description' => 'Pousser les limites de la gestion traditionnelle pour offrir des solutions avant-gardistes.'],
            ['title' => 'Intégrité', 'description' => 'Agir avec transparence et honnêteté dans toutes nos interactions.'],
            ['title' => 'Collaboration', 'description' => 'Favoriser le travail d\'équipe et la synergie pour surmonter les défis.'],
            ['title' => 'Excellence', 'description' => 'Viser l\’excellence dans chaque projet et chaque produit développé.'],
            ['title' => 'Responsabilité', 'description' => 'Assumer la responsabilité de nos produits et leur impact sur les utilisateurs.']
        ];

        return $this->render('values/index.html.twig', [
            'values' => $values
        ]);
    }
}
