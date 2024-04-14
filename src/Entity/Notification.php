<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NotificationRepository")
 */
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\ManyToOne(targetEntity:"Symfony\Component\Security\Core\User\UserInterface")]
    #[ORM\JoinColumn(nullable:false)]
    /* * Je stocke la référence à l'utilisateur qui reçoit la notification.*/ 

    private $user;

    #[ORM\Column(type:"string", length:255)]
     /** Je stocke le message de la notification.*/
    private $message;

    #[ORM\Column(type:"boolean")]
     /* Je stocke le statut de la notification, lu ou non lu.*/
    private $status;

    #[ORM\Column(type:"datetime")]
     /* Je stocke la date et l'heure de création de la notification.*/
    private $createdAt;

    public function __construct()
    {
        $this->status = false; // Les notifications sont non lues par défaut
        $this->createdAt = new \DateTime(); // La date de création est l'heure actuelle par défaut
    }

    // Getters et Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    public function setUser(UserInterface $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
