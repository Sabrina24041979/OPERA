<?php

namespace App\Repository;

use App\Entity\EmployeeSentiments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
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

    public function findAllByManager(int $employeeId)
    {
        return $this->createQueryBuilder('e')
            ->leftJoin('e.personal', 'employee')
            ->andWhere('employee.id = :employeeId')
            ->setParameter('employeeId', $employeeId)
            ->getQuery()
            ->getResult();
    }

    /**
     * Je recherche les sentiments par catégorie.
     */
    public function findByCategory(string $category): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.category = :category')
            ->setParameter('category', $category)
            ->getQuery()
            ->getResult();
    }

    /**
     * Je recherche les sentiments par intensité.
     */
    public function findByIntensity(string $intensity): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.intensity = :intensity')
            ->setParameter('intensity', $intensity)
            ->getQuery()
            ->getResult();
    }

    /**
     * Je recherche les sentiments dans une plage de dates.
     */
    public function findByDateRange(\DateTimeInterface $startDate, \DateTimeInterface $endDate): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.date BETWEEN :start AND :end')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->getQuery()
            ->getResult();
    }

    /**
     * Je recherche les sentiments avec plusieurs critères: catégorie et intensité.
     */
    public function findByCategoryAndIntensity(string $category, string $intensity): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.category = :category')
            ->andWhere('e.intensity = :intensity')
            ->setParameter('category', $category)
            ->setParameter('intensity', $intensity)
            ->getQuery()
            ->getResult();
    }
}
