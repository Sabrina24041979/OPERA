<?php

namespace App\Controller;

use DateTime;
use DateInterval;
use App\Repository\GoalRepository;
use App\Repository\TeamRepository;
use Symfony\Component\Mercure\Update;
use App\Repository\FeedbackRepository;
use App\Repository\PersonalRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(GoalRepository $goalRepository, FeedbackRepository $feedbackRepository, TeamRepository $teamRepository): Response
    {
        // Vérifier si l'utilisateur a le rôle de Manager
        $this->denyAccessUnlessGranted('ROLE_MANAGER');

        // Je récupère les objectifs depuis la base de données
        $objectifs = $goalRepository->findBy([], ['deadline' => 'ASC']);

        // Je récupère les feedbacks depuis la base de données
        $feedbacks = $feedbackRepository->findAll();

        // Je récupère les informations sur les équipes depuis la base de données
        $equipes = $teamRepository->findAll();

        // Je retourne la vue du tableau de bord avec les données récupérées
        return $this->render('dashboard/dashboard.html.twig', [
            'objectifs' => $objectifs,
            'feedbacks' => $feedbacks,
            'equipes' => $equipes,
        ]);
    }


    #[Route('/publish', name: 'publish')]
    public function publish(HubInterface $hub): Response
    {
        $user = $this->getUser(); // L"utilisateur connecté n'est pas reconnu et je ne sais pas pourquoi
        dd($user);

        if ($user) {
            $intervals = ['P0D', 'P83D', 'P85D', 'P87D', 'P90D'];
            $lastUpdatedPassword = $user->getLastUpdatedPassword();
            $today = new DateTime();

            foreach ($intervals as $interval) {
                $dateToCheck = clone $lastUpdatedPassword;
                $dateToCheck->add(new DateInterval($interval));
                if ($dateToCheck->format('Y-m-d') === $today->format('Y-m-d')) {
                    $update = new Update(
                        'notifPasswordReset',
                        'Veuillez modifier votre mot de passe'
                    );

                    $hub->publish($update);
                    return new Response('Notif envoyé!');
                }
            }
        }

        return new Response('Aucun notif envoyé!');
    }


    #[Route('/todo', name: 'todo')]
    public function hello(Request $request, RequestStack $requestStack): Response
    {

        //créeation d'une cookie 
        $cookie =  new Cookie('monCookie', '123', strtotime('now + 1 day'));

        // configuration du cookie 
        // dd($cookie);

        // $cookie->withHttpOnly(true); // lisible uniquement en HTTP, jamais avec JavaScript 


        // Rend la vue 

        $response = $this->render('dashboard/dashboard.html.twig');



        // Accompagne la vue avec le cookie 

        $response->headers->setCookie($cookie);



        return $response;
    }
}
