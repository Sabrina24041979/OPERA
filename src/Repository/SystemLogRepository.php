<?php

namespace App\Repository;

use App\Entity\SystemLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method SystemLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method SystemLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method SystemLog[]    findAll()
 * @method SystemLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SystemLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SystemLog::class);
    }

    /**
     * Retrieve logs based on the severity level.
     */
    public function findBySeverity($severity)
    {
        return $this->createQueryBuilder('sl')
            ->andWhere('sl.severity = :severity')
            ->setParameter('severity', $severity)
            ->getQuery()
            ->getResult();
    }

    /**
     * Retrieve logs for a specific date range.
     */
    public function findByDateRange(\DateTime $startDate, \DateTime $endDate)
    {
        return $this->createQueryBuilder('sl')
            ->andWhere('sl.createdAt BETWEEN :start AND :end')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->getQuery()
            ->getResult();
    }

    /**
     * Retrieve logs that match a specific message pattern.
     */
    public function findByMessagePattern($pattern)
    {
        return $this->createQueryBuilder('sl')
            ->andWhere('sl.message LIKE :pattern')
            ->setParameter('pattern', '%' . $pattern . '%')
            ->getQuery()
            ->getResult();
    }

    /**
     * Retrieve the most recent logs.
     */
    public function findRecentLogs($limit = 100)
    {
        return $this->createQueryBuilder('sl')
            ->orderBy('sl.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
