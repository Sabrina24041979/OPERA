<?php

namespace App\Controller;

use App\Repository\NotificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class NotificationController extends AbstractController
{
    private $notificationRepository;
    private $security;

    public function __construct(NotificationRepository $notificationRepository, Security $security)
    {
        $this->notificationRepository = $notificationRepository;
        $this->security = $security;
    }

    #[Route('/notifications', name: 'notification_index')]
    /* Je montre toutes les notifications pour l'utilisateur connecté.*/
    public function showNotifications(): Response
    {
        $user = $this->security->getUser();
        $notifications = $this->notificationRepository->findBy(['user' => $user]);

        return $this->render('notifications/index.html.twig', [
            'notifications' => $notifications
        ]);
    }

    #[Route('/notifications/{id}/read', name: 'notification_mark_read', methods: ['POST'])]
    /* Je marque toutes les notifications pour l'utilisateur connecté comme lues.*/
    public function markAsRead(): Response
    {
        $user = $this->security->getUser();
        $this->notificationRepository->markAllAsReadByUser($user);

        $this->addFlash('success', 'Toutes les notifications ont été marquées comme lues.');

        return $this->redirectToRoute('notifications_show');
    }
}
