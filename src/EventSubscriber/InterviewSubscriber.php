<?php

namespace App\EventSubscriber;

use App\Event\NewPersonalEvent;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class InterviewSubscriber implements EventSubscriberInterface
{
    public ?MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function onNewPersonalEvent(NewPersonalEvent $event): void
    {
        $email = new TemplatedEmail();
        $email->from('Service de Recrutement <service-recruitement@opera.com>')
            ->to('julien@gmail.com')
            ->subject('Entretien d\'embauche')
            ->htmlTemplate('emails/recruitmentInterview.html.twig');


        $this->mailer->send($email);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            NewPersonalEvent::class => 'onNewPersonalEvent',
        ];
    }
}
