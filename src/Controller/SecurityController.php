<?php

namespace App\Controller;

use DateTime;
use DateInterval;
use App\Entity\User;
use App\Entity\Personal;
use App\Form\PersonalType;
use App\Entity\Notification;
use App\Form\EmailCheckType;
use App\Form\PasswordResetType;
use App\Form\ChangePasswordType;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\PasswordResetRequestFormType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    #[Route("/login", name: "app_login")]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
    //
    #[Route('/email-check', name: 'check_email_submit', methods: ['GET', 'POST'])]
    public function checkEmail(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository, MailerInterface $mailer): Response
    {
        $form = $this->createForm(EmailCheckType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $user = $userRepository->findOneByEmail($email);

            if ($user) {
                $resetToken = uniqid('rst_', true); // Générer un token sécurisé
                $user->setResetToken($resetToken);
                $entityManager->flush();

                $resetUrl = $this->generateUrl('app_password_reset', ['token' => $resetToken], UrlGeneratorInterface::ABSOLUTE_URL);
                $email = (new Email())
                    ->from('noreply@example.com')
                    ->to($user->getEmail())
                    ->subject('Réinitialisation de votre mot de passe')
                    ->html("Pour réinitialiser votre mot de passe, veuillez cliquer sur ce lien: <a href='$resetUrl'>$resetUrl</a>");

                $mailer->send($email);

                $this->addFlash('success', 'Un email de réinitialisation a été envoyé à votre adresse.');
                return $this->redirectToRoute('app_login');
            } else {
                $this->addFlash('error', 'Aucun compte trouvé avec cet e-mail.');
            }
        }

        return $this->render('security/check_email.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /*
    #[Route('/change-password', name: 'change_password_submit', methods: ['POST'])]
    public function changePassword(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        // Réception du token de réinitialisation et du nouveau mot de passe via POST        
        $resetToken = $request->query->get('token');
        // Recherche de l'utilisateur par le token de réinitialisation
        $user = $userRepository->findOneBy(['resetToken' => $resetToken]);




        if (!$user) {
            // Gestion d'erreur si le token n'est pas valide
            throw new AccessDeniedException('Ce lien de réinitialisation de mot de passe n\’est plus valide ou a expiré..');
        }

        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);
        // Vérification que le token correspond à celui de l'utilisateur et hashage du nouveau mot de passe
        if ($form->isSubmitted() && $form->isValid()) {
            $newPassword = $form->get('newPassword')->getData();
            $user->setPassword($passwordHasher->hashPassword($user, $newPassword));
            $user->setResetToken(null);
            $entityManager->flush();

            $this->addFlash('success', 'Votre mot de passe a été mis à jour.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/change_password.html.twig', [
            'resetToken' => $resetToken,
            'form' => $form->createView(),
        ]);
    }

    */

    #[Route(name: 'change_password_submit')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function changePassword(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, Security $security): Response
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        } else {
            /** @var Personal */
            $user = $this->getUser();
        }

        $form = $this->createFormBuilder($user)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passes ne matchent pas',
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Mot de passe repeté'],
                'constraints' => [
                    new Assert\NotBlank(message: 'Le mot de passe ne doit pas être vide'),
                    new Assert\Length(
                        min: 12,
                        max: 24,
                        minMessage: 'Votre mot de passe doit contenir 12 caractères au moins',
                        maxMessage: 'Votre mot de passe doit contenir 24 caractères maximum'
                    ),
                    new Assert\Regex(
                        pattern: "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/",
                        match: true,
                        message: 'Le mot de passe doit contenir au moins un chiffre, une lettre minuscule, une lettre majuscule'
                    )
                ]
            ])
            ->add('Soumettre', SubmitType::class, [])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());
            // hasher le password et l'envoyer en BDD
            $plainPassword = $form["password"]->getData();
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);
            $user->setUpdatedAt(new DateTime());
            $user->setFirstConnexion(new DateTime());
            $user->setLastUpdatedPassword(new DateTime());
            $entityManager->persist($user);
            $entityManager->flush();


            // Envoyer un message de succès
            $this->addFlash("success", 'Mot de passe mis à jour avec succes');

            $security->logout(false); // déconnecter l'utilisateur après modification du mot de passe

            return new RedirectResponse($this->generateUrl('app_login')); // rediriger l'utilisateur vers la page de connexion 
        }

        return $this->render('security/change_password.html.twig', [
            'form' => $form
        ]);
    }


    #[Route("/logout", name: "app_logout", methods: ["GET"])]
    public function logout(): void
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    #[Route('/forget-password', name: 'app_forget_password', methods: ['GET', 'POST'])]
    public function forgetPassword(Request $request, UserRepository $userRepository, MailerInterface $mailer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PasswordResetRequestFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $user = $userRepository->findOneByEmail($email);

            if ($user) {
                $token = bin2hex(random_bytes(32));
                $user->setResetToken($token);
                $entityManager->persist($user);
                $entityManager->flush();

                $resetUrl = $this->generateUrl('app_reset_password', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);

                $email = (new Email())
                    ->from('noreply@example.com')
                    ->to($user->getEmail())
                    ->subject('Réinitialisation de votre mot de passe')
                    ->html("Pour réinitialiser votre mot de passe, veuillez cliquer sur le lien suivant : <a href='$resetUrl'>$resetUrl</a>");

                $mailer->send($email);

                $this->addFlash('success', 'Un email de réinitialisation de mot de passe a été envoyé.');
                return $this->redirectToRoute('app_forget_password');
            } else {
                $this->addFlash('danger', 'Aucun utilisateur trouvé avec cet email.');
            }
        }

        return $this->render('security/forget_password.html.twig', [
            'resetRequestForm' => $form->createView(),
        ]);
    }
    public function resetPassword(Request $request, $token, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = $userRepository->findOneBy(['resetToken' => $token]);

        if (!$user) {
            $this->addFlash('danger', 'Token invalide');
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(PasswordResetType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newPassword = $form->get('plainPassword')->getData();
            $user->setResetToken(null); // Effacer le token de réinitialisation
            $user->setPassword($passwordHasher->hashPassword($user, $newPassword));

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Votre mot de passe a été réinitialisé avec succès.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/reset_password.html.twig', [
            'resetForm' => $form->createView(),
        ]);
    }
}
