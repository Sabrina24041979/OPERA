<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ResourceLinkRepository;

#[ORM\Entity(repositoryClass:ResourceLinkRepository::class)]

class ResourceLink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(type:"string", length:255)]
     /* Je stocke le titre de la ressource.*/
   
    private $title;

    #[ORM\Column(type:"string", length:255)]
     /* Je stocke l'URL de la ressource.*/
     
    private $url;

   #[ORM\Column(type:"text")]
    /* Je stocke une description de la ressource.*/
    
    private $description;

    #[ORM\Column(type:"datetime")]
     /* Je stocke la date et l'heure de la création de la ressource.*/
    
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
