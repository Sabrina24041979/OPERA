<?php

namespace App\Controller;

use App\Entity\ResourceLink;
use App\Form\ResourceLinkType;
use App\Repository\ResourceLinkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/resources")]

class ResourceLinkController extends AbstractController
{
    
    #[Route('/', name:'resource_link_index', methods:["GET"])]
     /* Je liste toutes les ressources disponibles.*/
     
    public function index(ResourceLinkRepository $resourceLinkRepository): Response
    {
        return $this->render('resource_link/index.html.twig', [
            'resource_links' => $resourceLinkRepository->findAllSortedByDate(),
        ]);
    }

    #[Route('/new', name:'resource_link_new', methods:["GET", "POST"])]
    /* Je crée une nouvelle ressource.*/
    
    public function create(Request $request, ResourceLinkRepository $resourceLinkRepository): Response
    {
        $resourceLink = new ResourceLink();
        $form = $this->createForm(ResourceLinkType::class, $resourceLink);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resourceLinkRepository->save($resourceLink);

            return $this->redirectToRoute('resource_link_index');
        }

        return $this->render('resource_link/new.html.twig', [
            'resource_link' => $resourceLink,
            'form' => $form->createView(),
        ]);
    }

    #[Route("/{id}/edit", name:"resource_link_edit", methods:["GET", "POST"])]
    /* Je modifie une ressource existante.*/
    
    public function edit(Request $request, ResourceLink $resourceLink, ResourceLinkRepository $resourceLinkRepository): Response
    {
        $form = $this->createForm(ResourceLinkType::class, $resourceLink);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resourceLinkRepository->save($resourceLink);

            return $this->redirectToRoute('resource_link_index');
        }

        return $this->render('resource_link/edit.html.twig', [
            'resource_link' => $resourceLink,
            'form' => $form->createView(),
        ]);
    }
}
