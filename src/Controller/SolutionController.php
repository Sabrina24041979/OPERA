<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SolutionController extends AbstractController
{
    #[Route("/notre-solution", name:"app_notre_solution")]

    public function index(): Response
    {
        return $this->render('solution/index.html.twig');
    }
}
