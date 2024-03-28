<?php

namespace App\Repository;

use App\Entity\Performance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

class PerformanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Performance::class);
    }

    /**
     * Je récupère les performances d'un employé sur une période donnée.
     *
     * @param int $employeeId L'identifiant de l'employé
     * @param \DateTimeInterface $startDate La date de début de la période
     * @param \DateTimeInterface $endDate La date de fin de la période
     * @return Performance[] Les performances trouvées
     */
    public function findByEmployeeAndPeriod(int $employeeId, \DateTimeInterface $startDate, \DateTimeInterface $endDate): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.employee = :employeeId')
            ->andWhere('p.date >= :startDate')
            ->andWhere('p.date <= :endDate')
            ->setParameter('employeeId', $employeeId)
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->getQuery()
            ->getResult();
    }

    /**
     * Je calcule la moyenne des scores de performances pour un employé donné.
     *
     * @param int $employeeId L'identifiant de l'employé
     * @return float La moyenne des scores
     */
    public function findAverageScoreByEmployee(int $employeeId): float
    {
        $result = $this->createQueryBuilder('p')
            ->select('AVG(p.score) as averageScore')
            ->where('p.employee = :employeeId')
            ->setParameter('employeeId', $employeeId)
            ->getQuery()
            ->getSingleScalarResult();

        return (float) $result;
    }

    /**
     * Je trouve les performances les plus élevées pour chaque employé.
     *
     * @return Performance[] Les meilleures performances par employé
     */
    public function findTopPerformanceForEachEmployee(): array
    {
        $subQuery = $this->createQueryBuilder('sub')
            ->select('MAX(sub.score) as topScore', 'sub.employee')
            ->groupBy('sub.employee');

        $qb = $this->createQueryBuilder('p');
        $qb->where($qb->expr()->in('p.score', $subQuery->getDQL()))
           ->andWhere($qb->expr()->in('p.employee', $subQuery->getDQL()));

        return $qb->getQuery()->getResult();
    }
}
