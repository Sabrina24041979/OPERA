<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    /*l'action index() sera invoquée lorsque l'utilisateur accédera à la racine du site*/
    public function index(): Response
    {
        // Aucune logique métier spécifique n'est nécessaire ici pour le moment
        //La méthode render() est utilisée pour rendre la vue templates/home/index.html.twig 
        return $this->render('home/index.html.twig');
    }
}