<?php

namespace App\Repository;

use App\Entity\EmployeeSentiments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmployeeSentiments>
 *
 * @method EmployeeSentiments|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployeeSentiments|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployeeSentiments[]    findAll()
 * @method EmployeeSentiments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeeSentimentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployeeSentiments::class);
    }

//    /**
//     * @return EmployeeSentiments[] Returns an array of EmployeeSentiments objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EmployeeSentiments
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
