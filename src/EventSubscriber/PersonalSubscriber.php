<?php

namespace App\EventSubscriber;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class PersonalSubscriber implements EventSubscriberInterface
{
    public ?RouterInterface $router = null;
    public ?Security $security = null;
    public ?EntityManagerInterface $entityManager = null;
    public ?CacheInterface $cache = null;
    public ?RequestStack $requestStack = null;

    public function __construct(RouterInterface $router, Security $security, CacheInterface $cache, RequestStack $requestStack)
    {
        $this->router = $router;
        $this->security = $security;
        $this->cache = $cache;
        $this->requestStack = $requestStack;
    }

    public function onLoginSuccessEvent(LoginSuccessEvent $event)
    {
        // Enregistrer dans le cache le mail du dernier utilisateur connecté
        $personal = $event->getPassport()->getUser();
        $email = $personal->getEmail();

        // Enregistrer le mail de l'utiisateur connecté dans un attribut de session
        $session = $this->requestStack->getsession();
        $session->set("emailInCache",  $email);

        // Enregistrer le mail de l'utiisateur connecté dans un attribut de session
        $session = $this->requestStack->getsession();
        $session->set("emailInCache", $personal->getEmail());

        //dd($session);
        // dd($personal->getEmail());
        // Exemple de logique de mise en cache
        // $cacheKey = 'lastIdentifier_' . $email;

        $value = $this->cache->get('lastIdentifier', function (ItemInterface $item) use ($personal): string {
            // dd($personal);

            $item->expiresAfter(null); // délai d'expiration indéfini 

            $data = $personal->getEmail();;

            return $data;
        });

        //dd($value);

        /* Redirection de l'utilisateur si première connexion */

        //$request = $event->getRequest();
        if ($personal->getFirstConnexion() == null) {
            // Redirige vers une nouvelle URL
            $response = new RedirectResponse($this->router->generate('change_password_submit'));
            $event->setResponse($response); // Modifie la réponse de l'événement     
        }
    }

    public function OnLogoutEvent()
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            LoginSuccessEvent::class => ['onLoginSuccessEvent', 1000],
            LogoutEvent::class => ['OnLogoutEvent', 1001]
        ];
    }
}
