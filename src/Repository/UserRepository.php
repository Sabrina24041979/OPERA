<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Récupérer tous les utilisateurs avec un filtrage et un tri optionnels.
     *
     * @param array $criteria Critères pour filtrer les résultats.
     * @param array|null $orderBy Critères pour trier les résultats.
     * @return User[]
     */
    public function findAllUsers(array $criteria = [], array $orderBy = null): array
    {
        return $this->findBy($criteria, $orderBy);
    }

    /**
     * Trouver des utilisateurs par un rôle spécifique.
     *
     * @param string $role Le rôle à filtrer.
     * @return User[]
     */
    public function findUsersByRole(string $role): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere(':role MEMBER OF u.roles')
            ->setParameter('role', $role)
            ->getQuery()
            ->getResult();
    }

    /**
     * Récupérer un utilisateur par son identifiant.
     *
     * @param int $id L'identifiant de l'utilisateur.
     * @return User|null
     */
    public function findUserById(int $id): ?User
    {
        return $this->find($id);
    }

    /**
     * Méthode personnalisée pour rechercher des utilisateurs ayant des noms spécifiques.
     *
     * @param string $name Le nom à rechercher.
     * @return User[]
     */
    public function findUsersByName(string $name): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.name LIKE :name')
            ->setParameter('name', '%' . $name . '%')
            ->getQuery()
            ->getResult();
    }
}
