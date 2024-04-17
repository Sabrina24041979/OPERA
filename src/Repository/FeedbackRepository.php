<?php

namespace App\Repository;

use App\Entity\Feedback;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Feedback|null find($id, $lockMode = null, $lockVersion = null)
 * @method Feedback|null findOneBy(array $criteria, array $orderBy = null)
 * @method Feedback[]    findAll()
 * @method Feedback[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeedbackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Feedback::class);
    }

    /**
     * Je trouve tous les feedbacks associés à un collaborateur spécifique.
     */
    public function findByCollaborator($collaboratorId)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.collaborator = :val')
            ->setParameter('val', $collaboratorId)
            ->orderBy('f.date', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Je trouve les feedbacks récents à partir de la date spécifiée.
     */
    public function findRecentFeedbacks(\DateTime $sinceDate)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.date >= :since')
            ->setParameter('since', $sinceDate)
            ->orderBy('f.date', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Je compte le nombre de feedbacks pour un collaborateur spécifique.
     */
    public function countFeedbacksForCollaborator($collaboratorId)
    {
        return $this->createQueryBuilder('f')
            ->select('count(f.id)')
            ->andWhere('f.collaborator = :val')
            ->setParameter('val', $collaboratorId)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Je supprime tous les feedbacks pour un collaborateur spécifique.
     */
    public function deleteAllForCollaborator($collaboratorId)
    {
        return $this->createQueryBuilder('f')
            ->delete()
            ->where('f.collaborator = :val')
            ->setParameter('val', $collaboratorId)
            ->getQuery()
            ->execute();
    }
}
