<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * Ce repository permet de gérer les requêtes concernant les utilisateurs dans la base de données.
 */
class UserRepository extends ServiceEntityRepository
{
    /**
     * Je construis le repository en injectant le registre du manager de Doctrine.
     * Cela me permet d'accéder à la gestion des entités.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
     /**
     * Je crée une méthode qui utilise QueryBuilder pour obtenir des utilisateurs avec un critère spécifique.
     * Exemple : Récupérer tous les utilisateurs ayant le rôle 'ROLE_ADMIN'.
     */
    public function findUsersWithAdminRole(): array
    {
        return $this->createQueryBuilder('u')  // 'u' est un alias pour l'entité User dans la requête
            ->andWhere('u.roles LIKE :role')
            ->setParameter('role', '%"ROLE_ADMIN"%')  // La syntaxe pour les arrays JSON dans une requête SQL avec LIKE
            ->getQuery()
            ->getResult();
    }

    /**
     * Je récupère tous les utilisateurs avec une possibilité de filtrage et de tri.
     * 
     * @param array $criteria Critères de filtrage.
     * @param array $orderBy Critères de tri.
     * @return User[]
     */
    public function findAllUsers(array $criteria = [], array $orderBy = null): array
    {
        return $this->findBy($criteria, $orderBy);
    }

    /**
     * Je récupère un utilisateur par son identifiant.
     * 
     * @param int $id L'identifiant de l'utilisateur.
     * @return User|null
     */
    public function findUserById(int $id): ?User
    {
        return $this->find($id);
    }

    /**
     * Je recherche des utilisateurs en fonction de leur rôle.
     * Cette méthode est utile pour filtrer les utilisateurs selon leur niveau d'accès.
     * 
     * @param string $role Le rôle à filtrer.
     * @return User[]
     */
    public function findUsersByRole(string $role): array
    {
        $qb = $this->createQueryBuilder('u');
        $qb->where(':role MEMBER OF u.roles') // Assurez-vous que le champ 'roles' est configuré pour utiliser un array de rôles
            ->setParameter('role', $role);

        return $qb->getQuery()->getResult();
    }

    /**
     * Je crée une méthode personnalisée pour mettre à jour des informations spécifiques de l'utilisateur.
     * Cela pourrait inclure des opérations complexes non gérées par les méthodes par défaut.
     *
     * @param User $user L'utilisateur à mettre à jour.
     * @param array $data Les données à mettre à jour.
     */
    public function updateUser(User $user, array $data): void
    {
        if (isset($data['email'])) {
            $user->setEmail($data['email']);
        }
        if (isset($data['name'])) {
            $user->setName($data['name']);
        }
        //J'ajouterai d'autres champs au besoin

        $this->_em->persist($user);
        $this->_em->flush();
    }
}
