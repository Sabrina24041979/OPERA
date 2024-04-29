<?php

namespace App\Controller;

use App\Entity\Personal;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $personal = new Personal();
        $form = $this->createForm(RegistrationFormType::class, $personal);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $hashedPassword = $passwordHasher->hashPassword($personal, $form->get('plainPassword')->getData());
                $personal->setPassword($hashedPassword);
                $entityManager->persist($personal);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur est survenue lors de l’enregistrement.');
                return $this->redirectToRoute('app_register');
            }

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/register.html.twig', ['registrationForm' => $form->createView()]);
    }
}
