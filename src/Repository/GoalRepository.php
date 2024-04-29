<?php

namespace App\Repository;

use App\Entity\Goal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Goal>
 *
 * @method Goal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Goal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Goal[]    findAll()
 * @method Goal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GoalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Goal::class);
    }

    /**
     * Je récupère les objectifs par catégorie.
     */
    public function findByCategory($categoryId)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.category = :categoryId')
            ->setParameter('categoryId', $categoryId)
            ->getQuery()
            ->getResult();
    }

    /**
     * Je récupère les objectifs par priorité.
     */
    public function findByPriority($priority)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.priority = :priority')
            ->setParameter('priority', $priority)
            ->getQuery()
            ->getResult();
    }

    /**
     * Je récupère les objectifs par statut.
     */
    public function findByStatus($status)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.status = :status')
            ->setParameter('status', $status)
            ->getQuery()
            ->getResult();
    }

    /**
     * Je récupère les objectifs récents créés après une date spécifique.
     */
    public function findRecentGoals(\DateTimeInterface $sinceDate)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.createdAt >= :sinceDate')
            ->setParameter('sinceDate', $sinceDate)
            ->orderBy('g.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}

