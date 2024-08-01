<?php

namespace App\Event;

use App\Entity\Personal;
use Symfony\Contracts\EventDispatcher\Event;

class NewPersonalEvent extends Event
{
    private ?array $interviews = null;
    private ?Personal $newPersonal = null;

    public function __construct(array $interviews, Personal $newPersonal)
    {
        $this->interviews = $interviews;
        $this->newPersonal = $newPersonal;
    }

    /**
     * Get the value of interviews
     */
    public function getInterviews()
    {
        return $this->interviews;
    }

    /**
     * Get the value of newPersonal
     */
    public function getNewPersonal()
    {
        return $this->newPersonal;
    }
}
