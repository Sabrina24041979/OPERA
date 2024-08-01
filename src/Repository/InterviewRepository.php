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

    public function findAllByCollaborator(int $collaboratorId)
    {
        return $this->createQueryBuilder('i')
            ->leftJoin('i.interviewee', 'collaborator')
            // ->leftJoin('personal.manager', 'manager')
            ->andWhere('collaborator.id = :collaboratorId')
            ->setParameter('collaboratorId', $collaboratorId)
            ->getQuery()
            ->getResult();
    }

    public function findAllSortedByCollaborator()
    {
        return $this->createQueryBuilder('i')
            ->leftJoin('i.interviewee', 'interviewee')
            ->orderBy('interviewee.username', 'ASC')
            ->getQuery()
            ->getResult();
    }

public function countInterviewsForInterviewerOnDate($interviewer, \DateTime $date): int
{
    return $this->createQueryBuilder('i')
        ->select('COUNT(i.id)')
        ->where('i.interviewer = :interviewer')
        ->andWhere('i.date = :date')
        ->setParameter('interviewer', $interviewer)
        ->setParameter('date', $date->format('Y-m-d'))
        ->getQuery()
        ->getSingleScalarResult();
}
}
