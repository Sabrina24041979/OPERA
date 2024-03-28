<?php

namespace App\Repository;

use App\Entity\Evaluation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

class EvaluationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evaluation::class);
    }

    /**
     * Je récupère toutes les évaluations pour un employé spécifique.
     *
     * @param int $employeeId L'identifiant de l'employé
     * @return Evaluation[] Les évaluations trouvées
     */

    public function findByEmployee(int $employeeId): array
    {
        return $this->createQueryBuilder('e')
            ->where('e.employee = :employeeId')
            ->setParameter('employeeId', $employeeId)
            ->getQuery()
            ->getResult();
    }

    /**
     * Je calcule la moyenne des scores d'évaluations pour un employé donné.
     *
     * @param int $employeeId L'identifiant de l'employé
     * @return float La moyenne des scores
     */
    
    public function findAverageScoreByEmployee(int $employeeId): float
    {
        $result = $this->createQueryBuilder('e')
            ->select('AVG(e.score) as averageScore')
            ->where('e.employee = :employeeId')
            ->setParameter('employeeId', $employeeId)
            ->getQuery()
            ->getSingleScalarResult();

        return (float) $result;
    }

    /**
     * Je récupère les évaluations les plus récentes pour chaque employé.
     *
     * @return Evaluation[] Les évaluations les plus récentes
     */
    public function findLatestEvaluationForEachEmployee(): array
    {
        $subQuery = $this->createQueryBuilder('sub')
            ->select('MAX(sub.date) as latestDate', 'sub.employee')
            ->groupBy('sub.employee');

        $qb = $this->createQueryBuilder('e');
        $qb->where($qb->expr()->in('e.date', $subQuery->getDQL()))
           ->andWhere($qb->expr()->in('e.employee', $subQuery->getDQL()));

        return $qb->getQuery()->getResult();
    }
}
