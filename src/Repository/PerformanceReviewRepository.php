<?php

namespace App\Repository;

use App\Entity\PerformanceReview;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method PerformanceReview|null find($id, $lockMode = null, $lockVersion = null)
 * @method PerformanceReview|null findOneBy(array $criteria, array $orderBy = null)
 * @method PerformanceReview[]    findAll()
 * @method PerformanceReview[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerformanceReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PerformanceReview::class);
    }

    /**
     * Find the most recent performance reviews for a given user.
     */
    public function findRecentReviewsByUser($userId, $limit = 10)
    {
        return $this->createQueryBuilder('pr')
            ->andWhere('pr.user = :user')
            ->setParameter('user', $userId)
            ->orderBy('pr.reviewDate', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Find performance reviews within a specific date range.
     */
    public function findByDateRange(\DateTime $startDate, \DateTime $endDate)
    {
        return $this->createQueryBuilder('pr')
            ->andWhere('pr.reviewDate BETWEEN :start AND :end')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->getQuery()
            ->getResult();
    }

    /**
     * Find performance reviews based on specific criteria such as department or performance rating.
     */
    public function findByCriteria(array $criteria)
    {
        $query = $this->buildQueryByCriteria($criteria);

        return $query->getQuery()->getResult();
    }

    /**
     * Helper method to create a query based on different criteria.
     */
    private function buildQueryByCriteria(array $criteria): QueryBuilder
    {
        $query = $this->createQueryBuilder('pr');

        if (!empty($criteria['department'])) {
            $query->andWhere('pr.department = :department')
                  ->setParameter('department', $criteria['department']);
        }

        if (!empty($criteria['performanceRating'])) {
            $query->andWhere('pr.performanceRating = :rating')
                  ->setParameter('rating', $criteria['performanceRating']);
        }

        return $query;
    }
}
