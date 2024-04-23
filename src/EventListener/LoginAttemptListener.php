<?php

namespace App\EventListener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use App\Service\LoginAttemptService;

class LoginAttemptListener
{
    private LoginAttemptService $loginAttemptService;

    public function __construct(LoginAttemptService $loginAttemptService)
    {
        $this->loginAttemptService = $loginAttemptService;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        if ($this->loginAttemptService->isUserLockedOut($user)) {
            throw new CustomUserMessageAuthenticationException('Your account is locked due to too many failed login attempts.');
        }

        $this->loginAttemptService->resetLoginAttempts($user);
    }
}
