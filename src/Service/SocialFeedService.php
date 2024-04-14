<?php

namespace App\Service;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;

class SocialFeedService
{
    private $postRepository;
    private $entityManager;

    // Je déclare les dépendances nécessaires pour la gestion des posts
    public function __construct(PostRepository $postRepository, EntityManagerInterface $entityManager)
    {
        $this->postRepository = $postRepository;
        $this->entityManager = $entityManager;
    }

    // Je crée une méthode pour ajouter un nouveau post
    public function createPost(string $content, $user): Post
    {
        $post = new Post();
        $post->setContent($content);
        $post->setUser($user);
        $post->setCreatedAt(new \DateTime());
        $post->setUpdatedAt(new \DateTime());

        $this->entityManager->persist($post);
        $this->entityManager->flush();

        return $post;
    }

    // Je crée une méthode pour mettre à jour un post existant
    public function updatePost(Post $post, string $content): void
    {
        $post->setContent($content);
        $post->setUpdatedAt(new \DateTime());

        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }

    // Je crée une méthode pour supprimer un post
    public function deletePost(Post $post): void
    {
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }
}
