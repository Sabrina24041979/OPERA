<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\ORMException;

/**
 * UserRepository manages the data access layer for the User entity.
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Retrieves all users with optional filtering and sorting.
     *
     * @param array $criteria Criteria to filter the results.
     * @param array|null $orderBy Criteria to sort the results.
     * @return User[]
     */
    public function findAllUsers(array $criteria = [], array $orderBy = null): array
    {
        return $this->findBy($criteria, $orderBy);
    }

    /**
     * Finds users by a specific role.
     *
     * @param string $role The role to filter by.
     * @return User[]
     * @throws \RuntimeException When query execution fails.
     */
    public function findUsersByRole(string $role): array
    {
        try {
            return $this->createQueryBuilder('u')
                ->andWhere(':role MEMBER OF u.roles')
                ->setParameter('role', $role)
                ->getQuery()
                ->getResult();
        } catch (ORMException $e) {
            throw new \RuntimeException("Unable to retrieve users by role", 0, $e);
        }
    }

    /**
     * Retrieves a user by their ID.
     *
     * @param int $id The ID of the user.
     * @return User|null
     */
    public function findUserById(int $id): ?User
    {
        return $this->find($id);
    }

    /**
     * Finds users with a name containing a specific string.
     *
     * @param string $name The name to search for.
     * @return User[]
     * @throws \RuntimeException When query execution fails.
     */
    public function findUsersByName(string $name): array
    {
        try {
            return $this->createQueryBuilder('u')
                ->andWhere('u.name LIKE :name')
                ->setParameter('name', '%' . $name . '%')
                ->getQuery()
                ->getResult();
        } catch (ORMException $e) {
            throw new \RuntimeException("Unable to retrieve users by name", 0, $e);
        }
    }
}
