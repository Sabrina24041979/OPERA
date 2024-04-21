<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Repository\TaskRepository")]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\Column(type: "string")]
    private $name;

    // Assurez-vous que cette relation est bien définie
    #[ORM\ManyToOne(targetEntity: "App\Entity\User", inversedBy: "tasks")]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    // Getters et Setters pour $user
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    // Autres getters et setters...
}
