<?php

namespace App\Repository;

use App\Entity\Notification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Notification|null find($id, $lockMode = null, $lockVersion = null)
 * @method Notification|null findOneBy(array $criteria, array $orderBy = null)
 * @method Notification[]    findAll()
 * @method Notification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notification::class);
    }

    /**
     * Je récupère toutes les notifications non lues pour un utilisateur donné.
     * 
     * @param UserInterface $user L'utilisateur dont on veut récupérer les notifications
     * @return Notification[] Les notifications non lues de cet utilisateur
     */
    public function findUnreadByUser(UserInterface $user): array
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.user = :user')
            ->andWhere('n.status = :status')
            ->setParameter('user', $user)
            ->setParameter('status', false)
            ->orderBy('n.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Je marque toutes les notifications d'un utilisateur comme lues.
     *
     * @param UserInterface $user L'utilisateur dont les notifications doivent être marquées comme lues
     */
    public function markAllAsReadByUser(UserInterface $user): void
    {
        $this->createQueryBuilder('n')
            ->update()
            ->set('n.status', ':status')
            ->where('n.user = :user')
            ->setParameter('status', true)
            ->setParameter('user', $user)
            ->getQuery()
            ->execute();
    }
}
