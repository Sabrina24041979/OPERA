<?php

namespace App\Service;

use App\Entity\Notification;
use App\Repository\NotificationRepository;
use Doctrine\ORM\EntityManagerInterface;

class NotificationService
{
    private $entityManager;
    private $notificationRepository;

    // Je construis le service avec les dépendances nécessaires
    public function __construct(EntityManagerInterface $entityManager, NotificationRepository $notificationRepository)
    {
        $this->entityManager = $entityManager;
        $this->notificationRepository = $notificationRepository;
    }

    // Je crée une notification pour un utilisateur avec un message spécifique
    public function createNotification($user, $message): Notification
    {
        $notification = new Notification();
        $notification->setUser($user);
        $notification->setMessage($message);
        $notification->setStatus('unread'); // La notification est initialement non lue
        $notification->setCreatedAt(new \DateTime()); // La date de création est maintenant

        $this->entityManager->persist($notification);
        $this->entityManager->flush();

        return $notification;
    }

    // Je marque une notification comme lue
    public function markAsRead(Notification $notification): void
    {
        if ($notification->getStatus() !== 'read') {
            $notification->setStatus('read');
            $this->entityManager->flush();
        }
    }

    // Je récupère toutes les notifications pour un utilisateur donné
    public function getUserNotifications($user)
    {
        return $this->notificationRepository->findByUser($user);
    }
}
