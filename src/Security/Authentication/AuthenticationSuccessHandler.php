<?php
// src/Security/Authentication/AuthenticationSuccessHandler.php
namespace App\Security\Authentication;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    protected 
        $router;
    
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
    public function onAuthenticationSuccess(Request $request, TokenInterface $token): RedirectResponse
    {
        $user = $token->getUser();
        switch ($user->getRoles()[0]) {  // Assurez-vous que le rôle le plus important est en position 0
            case 'ROLE_ADMIN':
                return new RedirectResponse($this->router->generate('admin_dashboard'));
            case 'ROLE_DIRECTOR':
                return new RedirectResponse($this->router->generate('dashboard_manager_n2'));
            case 'ROLE_MANAGER_N1':
                return new RedirectResponse($this->router->generate('dashboard_manager_n1'));
            case 'ROLE_USER':
            default:
            return new RedirectResponse($this->router->generate('dashboard_user'));
        }
        return new RedirectResponse($this->router->generate('app_login'));
    }
}