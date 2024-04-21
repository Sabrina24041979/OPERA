<?php

namespace App\Repository;

use App\Entity\Manager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ManagerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Manager::class);
    }

    public function countTeamMembers()
    {
        return $this->createQueryBuilder('m')
            ->select('count(m.id)')  // Assurez-vous que 'id' est le champ correct pour compter les membres
            ->getQuery()
            ->getSingleScalarResult();
    }

    
}
