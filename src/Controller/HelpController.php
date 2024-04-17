<?php

namespace App\Controller;

use App\Entity\HelpDocument;
use App\Repository\HelpDocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelpController extends AbstractController
{
    #[Route("/help", name:"help_index")]
     /* Je montre la liste de tous les documents d'aide disponibles.*/
     
    public function index(HelpDocumentRepository $repository): Response
    {
        // Je récupère tous les documents d'aide depuis le repository.
        $documents = $repository->findAll();

        // Je rends la vue avec les documents récupérés.
        return $this->render('help/index.html.twig', [
            'documents' => $documents,
        ]);
    }

    #[Route("/help/{id}", name:"help_view")]
     /* Je montre un document d'aide spécifique.*/
     
    public function view(HelpDocument $document): Response
    {
        // Je rends la vue avec le document spécifié.
        return $this->render('help/view.html.twig', [
            'document' => $document,
        ]);
    }
}
