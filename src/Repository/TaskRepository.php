<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        // Je configure le repository pour fonctionner avec l'entité Task.
        parent::__construct($registry, Task::class);
    }

    /**
     * Je récupère les tâches complétées.
     */
    public function findCompletedTasks()
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.completed = :val')
            ->setParameter('val', true)
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Je récupère les tâches non complétées.
     */
    public function findPendingTasks()
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.completed = :val')
            ->setParameter('val', false)
            ->orderBy('t.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
