<?php

namespace App\Scheduler\Handler;

use DateTime;
use DateInterval;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Mercure\Update;
use App\Repository\PersonalRepository;
use Symfony\Component\Mercure\HubInterface;
use App\Scheduler\Message\ResetPasswordNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ResetPasswordNotificationHandler
{

    public function __construct(private HubInterface $hub, private CacheItemPoolInterface $cacheItemPool, private PersonalRepository $personalRepository)
    {
    }

    public function __invoke(ResetPasswordNotification $message)
    {

        $item = $this->cacheItemPool->getItem('lastIdentifier');
        $emailConnectedUser  = $item->get('lastIdentifier');

        // dd($item);
        $user = $this->personalRepository->findOneBy(
            [
                'email' => $emailConnectedUser,
            ]
        );
        // dd($user);
        dump("hello world");

        if ($user) {
            $chanel = 'notifPasswordReset' . $emailConnectedUser; // Le canal de chaque notification est unique pour chaque utilisateur
            $intervals = ['P0D', 'P83D', 'P85D', 'P87D', 'P90D'];
            $lastUpdatedPassword = $user->getLastUpdatedPassword();
            if ($lastUpdatedPassword == null) {
                throw new \ErrorException('Le password est null');
            }
            foreach ($intervals as $interval) {
                $today = new DateTime();
                $dateToCheck = clone $lastUpdatedPassword;
                $dateToCheck->add(new DateInterval($interval));
                if ($dateToCheck->format('Y-m-d') === $today->format('Y-m-d')) {
                    //   dd("ok");
                    $update = new Update(
                        $chanel,
                        'Veuillez modifier votre mot de passe'
                    );
                    $this->hub->publish($update);
                }
            }
        } else {
            throw new \ErrorException("Aucun utilisateur connecté");
        }

        //$this->cacheItemPool->deleteItem('lastIdentifier');
    }
}
