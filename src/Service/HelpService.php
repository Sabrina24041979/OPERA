<?php

namespace App\Service;

use App\Entity\HelpDocument;
use App\Repository\HelpDocumentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class HelpService
{
    private $helpDocumentRepository;
    private $entityManager;

    /**
     * Je construis le service en injectant les dépendances nécessaires.
     */
    public function __construct(HelpDocumentRepository $helpDocumentRepository, EntityManagerInterface $entityManager)
    {
        $this->helpDocumentRepository = $helpDocumentRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * Je crée un nouveau document d'aide.
     */
    public function createHelpDocument(string $title, string $content, string $category): HelpDocument
    {
        $helpDocument = new HelpDocument();
        $helpDocument->setTitle($title);
        $helpDocument->setContent($content);
        $helpDocument->setCategory($category);
        $helpDocument->setCreatedAt(new \DateTime());

        $this->entityManager->persist($helpDocument);
        $this->entityManager->flush();

        return $helpDocument;
    }

    /**
     * Je modifie un document d'aide existant.
     */
    public function updateHelpDocument(HelpDocument $helpDocument, string $title, string $content, string $category): HelpDocument
    {
        if (!$helpDocument) {
            throw new BadRequestException('Document not found.');
        }

        $helpDocument->setTitle($title);
        $helpDocument->setContent($content);
        $helpDocument->setCategory($category);
        $helpDocument->setUpdatedAt(new \DateTime());

        $this->entityManager->flush();

        return $helpDocument;
    }

    /**
     * Je supprime un document d'aide.
     */
    public function deleteHelpDocument(HelpDocument $helpDocument)
    {
        if (!$helpDocument) {
            throw new BadRequestException('Document not found.');
        }

        $this->entityManager->remove($helpDocument);
        $this->entityManager->flush();
    }
}
