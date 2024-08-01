<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;

class UserService
{
    private ?Security $security = null;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    public function getUser(): ?User
    {
        return $this->security->getUser();
    }
}
