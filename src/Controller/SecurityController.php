<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    
    #[Route("/login", name: "app_login")] #Je prévoies d'avoir une page d'accueil séparée accessible aux utilisateurs non authentifiés, je déplace la route de connexion vers un autre chemin, par exemple "/login". 

    //AuthenticationUtils pour simplifier l'obtention des erreurs d'authentification et du dernier nom d'utilisateur entré
    //Ici la méthode login gère l'affichage du formulaire de connexion 
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Je récupère l'erreur de connexion s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        
        // Je récupère le dernier nom d'utilisateur saisi par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        // Je rends le template de connexion en passant les variables nécessaires
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * Ceci est la route de déconnexion. Symfony s'occupera de tout ici en raison de la configuration security.yaml
     */ 
    #[Route("/logout", name: "app_logout", methods: ["GET"])]
     
    // Ici la méthode logout est définie pour permettre la déconnexion, même si son corps reste vide
    public function logout(): void
    {
        // Je laisse Symfony gérer la déconnexion, donc cette méthode peut rester vide.
    }
}