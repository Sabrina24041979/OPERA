<?php

namespace App\Repository;

use App\Entity\Manager;
use App\Entity\Personal;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class ManagerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Manager::class);
    }

    public function countTeamMembers(Personal $personal)
    {
        return $this->createQueryBuilder('m')
            ->select('count(p.id)')
            ->join('m.personals', 'p')
            ->where('m.id = :managerId')
            ->setParameter('managerId', $personal->getManager()->getId())
            ->getQuery()
            ->getSingleScalarResult();
    }
}
