<?php

namespace App\Repository;

use App\Entity\HelpDocument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method HelpDocument|null find($id, $lockMode = null, $lockVersion = null)
 * @method HelpDocument|null findOneBy(array $criteria, array $orderBy = null)
 * @method HelpDocument[]    findAll()
 * @method HelpDocument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HelpDocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HelpDocument::class);
    }

    /**
     * Je récupère tous les documents d'aide par catégorie spécifique.
     */
    public function findByCategory(string $category): array
    {
        return $this->createQueryBuilder('h')
            ->where('h.category = :category')
            ->setParameter('category', $category)
            ->getQuery()
            ->getResult();
    }

    /**
     * Je recherche les documents par titre avec une correspondance partielle.
     */
    public function searchByTitle(string $title): array
    {
        return $this->createQueryBuilder('h')
            ->where('h.title LIKE :title')
            ->setParameter('title', '%' . $title . '%')
            ->getQuery()
            ->getResult();
    }

    /**
     * Je crée un QueryBuilder pour les documents d'aide.
     * Cela peut être utile pour des requêtes personnalisées ou complexes.
     */
    public function createHelpDocumentQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('h');
    }
}
