<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Form\ProfileType;
use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profile')]
class ProfileController extends AbstractController
{
    #[Route('/', name: 'app_profile_index', methods: ['GET'])]
    public function index(ProfileRepository $profileRepository): Response
    {
        // Je récupère tous les profils pour les afficher dans l'index.
        return $this->render('profile/index.html.twig', [
            'profiles' => $profileRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_profile_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $profile = new Profile();
        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($profile);
            $entityManager->flush();

            // Après l'enregistrement, je redirige vers l'index des profils.
            return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        // Je rends le template de création de profil.
        return $this->render('profile/new.html.twig', [
            'profile' => $profile,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_profile_show', methods: ['GET'])]
    public function show(Profile $profile): Response
    {
        // J'affiche les détails d'un profil spécifique.
        return $this->render('profile/show.html.twig', [
            'profile' => $profile,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Profile $profile, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // Après la mise à jour, je redirige vers l'index des profils.
            return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        // Je rends le template d'édition de profil.
        return $this->render('profile/edit.html.twig', [
            'profile' => $profile,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_profile_delete', methods: ['POST'])]
    public function delete(Request $request, Profile $profile, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profile->getId(), $request->request->get('_token'))) {
            $entityManager->remove($profile);
            $entityManager->flush();
        }

        // Après la suppression, je redirige vers l'index des profils.
        return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
    }
}
