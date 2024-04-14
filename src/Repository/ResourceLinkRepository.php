<?php

namespace App\Repository;

use App\Entity\ResourceLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResourceLink|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResourceLink|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResourceLink[]    findAll()
 * @method ResourceLink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResourceLinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResourceLink::class);
    }

    /**
     * Je récupère toutes les ressources triées par date de création.
     */
    public function findAllSortedByDate()
    {
        return $this->createQueryBuilder('r')
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Je recherche des ressources en fonction d'un terme de recherche.
     *
     * @param string $term Le terme de recherche
     * @return ResourceLink[]
     */
    public function searchByTerm(string $term)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.title LIKE :term OR r.description LIKE :term')
            ->setParameter('term', '%' . $term . '%')
            ->getQuery()
            ->getResult();
    }

    /**
     * Je sauvegarde une nouvelle ressource dans la base de données.
     *
     * @param ResourceLink $resourceLink L'instance de ResourceLink à enregistrer
     */
    public function save(ResourceLink $resourceLink)
    {
        $this->_em->persist($resourceLink);
        $this->_em->flush();
    }

    /**
     * Je supprime une ressource spécifiée de la base de données.
     *
     * @param ResourceLink $resourceLink L'instance de ResourceLink à supprimer
     */
    public function remove(ResourceLink $resourceLink)
    {
        $this->_em->remove($resourceLink);
        $this->_em->flush();
    }
}
