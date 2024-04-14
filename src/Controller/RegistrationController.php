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

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $personal = new Personal(); // Je crée une nouvelle instance de mon entité Personal pour un nouvel utilisateur.
        
        $form = $this->createForm(RegistrationFormType::class, $personal); // Je crée le formulaire d'enregistrement en lui associant mon utilisateur.

        $form->handleRequest($request); // Je gère la requête pour voir si le formulaire a été soumis et est valide.
    
        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword($personal, $form->get('plainPassword')->getData()); // Je hash le mot de passe de l'utilisateur.
            $personal->setPassword($hashedPassword); // Je définis le mot de passe hashé pour l'utilisateur.
    
            $entityManager->persist($personal); // J'enregistre l'utilisateur dans la base de données.
            $entityManager->flush(); // Je valide les changements dans la base de données.

            return $this->redirectToRoute('app_login'); // Je redirige l'utilisateur vers la page de connexion après l'enregistrement.
        }

        return $this->render('security/register.html.twig', ['registrationForm' => $form->createView()]); // Je rends le template de l'enregistrement en lui passant le formulaire à afficher.
    }
}
