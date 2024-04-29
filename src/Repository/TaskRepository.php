<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function findCompletedTasks(): array
    {
        return $this->findBy(['completed' => true]);
    }

    public function findPendingTasks(): array
    {
        return $this->findBy(['completed' => false]);
    }
}
