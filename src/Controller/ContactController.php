<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Form\ContactType;  // Assurez-vous de créer un formulaire Symfony ContactType approprié.

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact_us')]
    public function contactPage(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactData = $form->getData();
            // Traiter les données ici, comme l'envoi d'un email

            // Après traitement, rediriger vers une page de remerciement ou réafficher le formulaire avec un message de succès
            $this->addFlash('success', 'Votre message a été envoyé avec succès!');
            return $this->redirectToRoute('contact_us');
        }

        // Afficher le formulaire ou le réafficher avec des erreurs
        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
