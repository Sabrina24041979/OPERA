<?php

namespace App\Repository;

use App\Entity\Workload;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class WorkloadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Workload::class);
    }

    public function findAllByManager(int $employeeId)
    {
        return $this->createQueryBuilder('w')
            ->leftJoin('w.personal', 'employee')
            ->andWhere('employee.id = :employeeId')
            ->setParameter('employeeId', $employeeId)
            ->getQuery()
            ->getResult();
    }
}
