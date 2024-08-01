<?php

namespace App\Event;

use App\Entity\Personal;
use Symfony\Contracts\EventDispatcher\Event;

class PersonalCreatedEvent extends Event
{
    public const NAME = 'personnal.created';

    protected $personnal;

    public function __construct(

       Personal $personal
    ) {
        $this->personal = $personal;
    }

    public function getPersonal(): Personal
    {
        return $this->personal;
    }
}