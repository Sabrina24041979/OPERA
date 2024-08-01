<?php

namespace App\Scheduler;

use App\Scheduler\Message\ResetPasswordNotification;
use Symfony\Component\Scheduler\Attribute\AsSchedule;
use Symfony\Component\Scheduler\RecurringMessage;
use Symfony\Component\Scheduler\Schedule;
use Symfony\Component\Scheduler\ScheduleProviderInterface;
use Symfony\Contracts\Cache\CacheInterface;

#[AsSchedule]
final class MainSchedule implements ScheduleProviderInterface
{
    public function __construct(
        private CacheInterface $cache,
    ) {
    }

    public function getSchedule(): Schedule
    {
        return (new Schedule())
            ->add(
                // @TODO - Create a Message to schedule
                // RecurringMessage::every('1 hour', new App\Message\Message()),
                RecurringMessage::every('2 second', new ResetPasswordNotification())
            )
            ->stateful($this->cache);
    }
}
