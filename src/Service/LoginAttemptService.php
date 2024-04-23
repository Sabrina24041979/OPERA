<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LoginAttemptService
{
    const MAX_ATTEMPTS = 5;
    const LOCKOUT_TIME = 300; // En secondes (5 minutes)

    private EntityManagerInterface $entityManager;
    private SessionInterface $session;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    public function recordFailedLogin(User $user): void
    {
        $user->setLoginAttempts($user->getLoginAttempts() + 1);
        if ($user->getLoginAttempts() >= self::MAX_ATTEMPTS) {
            $user->setLockoutTime(new \DateTime("+" . self::LOCKOUT_TIME . " seconds"));
        }
        $this->entityManager->flush();
    }

    public function isUserLockedOut(User $user): bool
    {
        return $user->getLockoutTime() && $user->getLockoutTime() > new \DateTime();
    }

    public function resetLoginAttempts(User $user): void
    {
        $user->setLoginAttempts(0);
        $user->setLockoutTime(null);
        $this->entityManager->flush();
    }
}
