<?php

namespace App\Repository;

use App\Entity\TypeInterview;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeInterview>
 *
 * @method TypeInterview|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeInterview|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeInterview[]    findAll()
 * @method TypeInterview[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeInterviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeInterview::class);
    }

//    /**
//     * @return TypeInterview[] Returns an array of TypeInterview objects
//     */
   public function findByExampleField($value): array
   {
       return $this->createQueryBuilder('t')
           ->andWhere('t.exampleField = :val')
           ->setParameter('val', $value)
           ->orderBy('t.id', 'ASC')
           ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
   }

   public function findOneBySomeField($value): ?TypeInterview
   {
       return $this->createQueryBuilder('t')
           ->andWhere('t.exampleField = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }
}
