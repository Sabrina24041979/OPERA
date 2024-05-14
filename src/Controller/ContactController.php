<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route("/contact", name: "app_contact")]
    public function contactPage(): Response
    {
        // Assurez-vous que le fichier Twig 'contact.html.twig' existe dans le dossier 'templates/contact'
        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    #[Route('/contact/submit', name: 'app_contact_submit', methods: ['POST'])]
    public function handleSubmit(Request $request): Response
    {
        // Récupérez les données du formulaire ici et traitez-les
        $name = $request->request->get('name');
        $email = $request->request->get('email');
        $message = $request->request->get('message');

        // Logique pour envoyer un email ou sauvegarder les données

        $this->addFlash('success', 'Votre message a été envoyé avec succès.');
        return $this->redirectToRoute('app_contact');
    }
}
