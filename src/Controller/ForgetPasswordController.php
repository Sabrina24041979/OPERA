<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForgetPasswordController extends AbstractController
{
    #[Route('/forget-password', name: 'app_forget_password_request')]
    
    public function forgetPassword(): Response
{
        // Je mets en place la logique pour demander la réinitialisation du mot de passe
        // Cela peut inclure l'affichage d'un formulaire pour que l'utilisateur puisse entrer son email

        return $this->render('security/forget_password.html.twig');
    }

    /**
     * Je peux ajouter d'autres méthodes ici pour gérer la soumission du formulaire,
     * l'envoi d'un email de réinitialisation, etc.
     */
}

