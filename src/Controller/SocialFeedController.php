<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class SocialFeedController extends AbstractController
{
    private $entityManager;
    private $postRepository;

    // Je configure le constructeur pour injecter les dépendances nécessaires
    public function __construct(EntityManagerInterface $entityManager, PostRepository $postRepository)
    {
        $this->entityManager = $entityManager;
        $this->postRepository = $postRepository;
    }

   #[Route("/social-feed", name:"social_feed")]
    /* Je montre tous les posts sur le mur social.*/
    
    public function index(): Response
    {
        $posts = $this->postRepository->findAllPosts();

        return $this->render('social_feed/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route("/social-feed/create", name:"social_feed_create", methods:["GET", "POST"])]
    /* Je gère la création de nouveaux posts.*/

    public function create(Request $request, UserInterface $user): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setUser($user);
            $post->setCreatedAt(new \DateTime());

            $this->entityManager->persist($post);
            $this->entityManager->flush();

            return $this->redirectToRoute('social_feed');
        }

        return $this->render('social_feed/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route("/social-feed/edit/{id}", name:"social_feed_edit", methods:["GET", "POST"])]
    /* Je gère la modification des posts existants.*/
     
    public function edit(Request $request, Post $post): Response
    {
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('social_feed');
        }

        return $this->render('social_feed/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }
}
