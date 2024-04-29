<?php

namespace App\Repository;

use App\Entity\PasswordResetRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PasswordResetRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method PasswordResetRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method PasswordResetRequest[]    findAll()
 * @method PasswordResetRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PasswordResetRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PasswordResetRequest::class);
    }

    public function findOneByToken(string $token): ?PasswordResetRequest
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.token = :token')
            ->setParameter('token', $token)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
