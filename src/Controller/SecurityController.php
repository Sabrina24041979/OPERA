<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Routing\RouterInterface; 

class SecurityController extends AbstractController
{
    
        private $router; // Je déclare une propriété pour le routeur
    
        // J'injecte le RouterInterface dans le constructeur
        public function __construct(RouterInterface $router)
        {
            $this->router = $router;
        }
    
    #[Route("/login", name: "app_login")] //Je prévoies d'avoir une page d'accueil séparée accessible aux utilisateurs non authentifiés, je déplace la route de connexion vers un autre chemin, par exemple "/login". 

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
         // Le contrôleur peut être vide, il ne sera jamais exécuté !
        // Symfony interceptera cette route pour effectuer le processus de déconnexion.
        throw new \Exception('Don\'t forget to activate logout in security.yaml');// Cette méthode ne sera jamais exécutée car la gestion est faite par Symfony
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
{
        $user = $token->getUser();
        switch ($user->getRoles()[0]) {  // Assurez-vous que le rôle le plus important est en position 0
            case 'ROLE_ADMIN':
                return new RedirectResponse($this->router->generate('dashboard_director'));
            case 'ROLE_DIRECTOR':
                return new RedirectResponse($this->router->generate('dashboard_manager_n2'));
            case 'ROLE_MANAGER_N1':
                return new RedirectResponse($this->router->generate('dashboard_manager_n1'));
            case 'ROLE_USER':
            default:
                return new RedirectResponse($this->router->generate('dashboard_user'));
        }
    }
}