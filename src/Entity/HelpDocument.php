<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

    #[ORM\Entity(repositoryClass:"App\Repository\HelpDocumentRepository")]
    #[ORM\HasLifecycleCallbacks()]

class HelpDocument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(type:"string", length:255)]
    #[Assert\NotBlank()]
     /* Je définis le titre du document d'aide.*/

    private $title;

    #[ORM\Column(type:"text")]
    #[Assert\NotBlank()]
     /* Je définis le contenu du document d'aide.*/

    private $content;

    #[ORM\Column(type:"string", length:255)]
    #[Assert\NotBlank()]
     /* Je définis la catégorie du document d'aide.*/

    private $category;

    #[ORM\Column(type:"datetime")]
     /* Je définis la date de création du document d'aide.*/
    private $createdAt;

    #[ORM\Column(type:"datetime", nullable:true)]
    /* Je définis la date de mise à jour du document d'aide.*/
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    #[ORM\PrePersist]
     /* Je m'assure que la date de création est définie juste avant la première persistance de l'entité.*/
    public function setCreatedAt(): void
    {
        $this->createdAt = new \DateTime();
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }
}
