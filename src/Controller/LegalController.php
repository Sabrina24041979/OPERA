<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LegalController extends AbstractController
{
    #[Route("/conditions-utilisation", name:"app_conditions_utilisation")]
    
    public function conditionsUtilisation(): Response
    {
        return $this->render('legal/conditions_utilisation.html.twig');
    }
}
