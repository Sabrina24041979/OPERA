<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

class MailController extends AbstractController
{
    #[Route('/email', name: 'mailing')]
    public function index(MailerInterface $mailer): Response
    {

        $email = new TemplatedEmail();
        $email->from('Service de Recrutement <service-recruitement@opera.com>')
            ->to('julien@gmail.com')
            ->subject('Entretien d\'embauche')
            ->htmlTemplate('emails/recruitmentInterview.html.twig');


        $mailer->send($email);

        return $this->redirectToRoute('app_personal_index', []);
    }
}
