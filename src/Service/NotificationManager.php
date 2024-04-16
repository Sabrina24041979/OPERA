<?php

namespace App\Service;

use App\Entity\Notification;
use App\Repository\NotificationRepository;
use Doctrine\ORM\EntityManagerInterface;

class NotificationManager
{
    private $notificationRepository;
    private $entityManager;

    // Je déclare les dépendances nécessaires pour la gestion des notifications.
    public function __construct(NotificationRepository $notificationRepository, EntityManagerInterface $entityManager)
    {
        $this->notificationRepository = $notificationRepository;
        $this->entityManager = $entityManager;
    }

    // Je récupère les notifications pour un utilisateur spécifique.
    public function getNotificationsForUser($user)
    {
        return $this->notificationRepository->findByUser($user);
    }

    // Je crée une nouvelle notification.
    public function createNotification(Notification $notification)
    {
        $this->entityManager->persist($notification);
        $this->entityManager->flush();
    }

    // Je marque toutes les notifications d'un utilisateur comme lues.
    public function markAllAsRead($user)
    {
        $notifications = $this->notificationRepository->findByUser($user);
        foreach ($notifications as $notification) {
            $notification->setStatus('read');
        }
        $this->entityManager->flush();
    }
}
