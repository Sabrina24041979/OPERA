<?php

namespace App\Repository;

use App\Entity\Interview;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class InterviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Interview::class);
    }

    public function findByStatus($status)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.status = :status')
            ->setParameter('status', $status)
            ->getQuery()
            ->getResult();
    }

    public function findAllByManager(int $managerId)
    {
        return $this->createQueryBuilder('i')
            ->leftJoin('i.interviewer', 'manager')
            // ->leftJoin('personal.manager', 'manager')
            ->andWhere('manager.id = :managerId')
            ->setParameter('managerId', $managerId)
            ->getQuery()
            ->getResult();
    }
}
