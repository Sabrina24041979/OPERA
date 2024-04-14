<?php

namespace App\Service;

use App\Entity\ResourceLink;
use App\Repository\ResourceLinkRepository;
use Doctrine\ORM\EntityManagerInterface;

class ResourceLinkService
{
    private $resourceLinkRepository;
    private $entityManager;

    // Je construis mon service en injectant les dépendances nécessaires.
    public function __construct(ResourceLinkRepository $resourceLinkRepository, EntityManagerInterface $entityManager)
    {
        $this->resourceLinkRepository = $resourceLinkRepository;
        $this->entityManager = $entityManager;
    }

    // Je crée une méthode pour ajouter une nouvelle ressource.
    public function createResource(string $title, string $url, string $description): ResourceLink
    {
        $resource = new ResourceLink();
        $resource->setTitle($title);
        $resource->setUrl($url);
        $resource->setDescription($description);

        $this->entityManager->persist($resource);
        $this->entityManager->flush();

        return $resource;
    }

    // Je crée une méthode pour modifier une ressource existante.
    public function updateResource(ResourceLink $resource, array $data): ResourceLink
    {
        if (isset($data['title'])) {
            $resource->setTitle($data['title']);
        }
        if (isset($data['url'])) {
            $resource->setUrl($data['url']);
        }
        if (isset($data['description'])) {
            $resource->setDescription($data['description']);
        }

        $this->entityManager->flush();

        return $resource;
    }

    // Je crée une méthode pour supprimer une ressource.
    public function deleteResource(ResourceLink $resource): void
    {
        $this->entityManager->remove($resource);
        $this->entityManager->flush();
    }
}
