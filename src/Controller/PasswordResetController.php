<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\PasswordResetRequest;
use App\Form\PasswordResetRequestType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PasswordResetRequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class PasswordResetController extends AbstractController
{
    #[Route('/password-reset', name: 'app_password_reset')]
    public function request(Request $request, UserRepository $userRepository, TokenGeneratorInterface $tokenGenerator, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PasswordResetRequestType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $user = $userRepository->findOneByEmail($email);

            if ($user) {
                $resetToken = new PasswordResetRequest();
                $resetToken->setUser($user);
                $resetToken->setToken($tokenGenerator->generateToken());
                $resetToken->setExpiresAt((new \DateTime())->modify('+1 hour'));

                $entityManager->persist($resetToken);
                $entityManager->flush();

                // Envoyer l'email ici avec le lien de réinitialisation
            }

            return $this->redirectToRoute('app_password_reset_request_sent');
        }

        return $this->render('password_reset/request.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/password-reset/{token}', name: 'app_password_reset_token')]
    public function reset(string $token, PasswordResetRequestRepository $passwordResetRequestRepository): Response
    {
        $resetRequest = $passwordResetRequestRepository->findOneByToken($token);

        if (!$resetRequest || $resetRequest->isExpired()) {
            // Gérer l'expiration ou l'invalidité du token
            return $this->redirectToRoute('app_password_reset');
        }

        // Traiter la réinitialisation ici

        return $this->render('password_reset/reset.html.twig', [
            'token' => $token,
        ]);
    }
}
