<?php

namespace App\Repository;

use App\Entity\Objective;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Je suis le repository pour les entités Objective.
 * Je permets de centraliser la logique d'accès aux données pour les objectifs,
 * facilitant ainsi la réutilisation et la maintenance du code.
 */
class ObjectiveRepository extends ServiceEntityRepository
{
    /**
     * Le constructeur injecte le ManagerRegistry pour accéder à l'EntityManager de Doctrine.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Objective::class);
    }

    /**
     * Je récupère un objectif par son identifiant.
     */
    public function findOneById(int $id): ?Objective
    {
        return $this->find($id);
    }

    /**
     * Je récupère tous les objectifs avec des critères de tri et de limitation.
     */
    public function findByCriteria(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * Je trouve les objectifs par leur statut de réalisation.
     */
    public function findByCompletionStatus(int $status)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.completionStatus = :status')
            ->setParameter('status', $status)
            ->getQuery()
            ->getResult();
    }

    // D'autres méthodes spécifiques peuvent être ajoutées ici pour traiter des requêtes complexes.
}

