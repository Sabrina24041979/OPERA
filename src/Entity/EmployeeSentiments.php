<?php

namespace App\Entity;

use App\Repository\EmployeeSentimentsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

// Je définis la classe EmployeeSentiments comme une entité Doctrine.
#[ORM\Entity(repositoryClass: EmployeeSentimentsRepository::class)]
class EmployeeSentiments
{
    // Je déclare les propriétés de l'entité avec leurs types et contraintes.
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sentiment_value = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comment = null;

    // Je mets en place une relation ManyToOne avec l'entité Personal.
    #[ORM\ManyToOne(inversedBy: 'employeeSentiments')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Personal $personal = null;

    // Je définis les getters et setters pour chaque propriété.
    // Ces méthodes permettent de manipuler les attributs de l'entité de manière contrôlée.

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSentimentValue(): ?string
    {
        return $this->sentiment_value;
    }

    public function setSentimentValue(?string $sentiment_value): static
    {
        $this->sentiment_value = $sentiment_value;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getPersonal(): ?Personal
    {
        return $this->personal;
    }

    public function setPersonal(?Personal $personal): static
    {
        $this->personal = $personal;
        return $this;
    }
}
