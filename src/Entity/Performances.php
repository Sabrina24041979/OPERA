<?php

namespace App\Entity;

use App\Repository\PerformanceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerformanceRepository::class)]

class Performance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    // J\'utilise une propriété 'titre' pour donner un nom à cette performance.
    private ?string $titre = null;

    #[ORM\Column(type: "text")]
    // Je stocke une description détaillée de la performance ici.
    private ?string $description = null;

    #[ORM\Column(type: "datetime")]
    // La date et l'heure de l'évaluation de cette performance.
    private ?\DateTimeInterface $dateEvaluation = null;

    // Getters et Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDateEvaluation(): ?\DateTimeInterface
    {
        return $this->dateEvaluation;
    }

    public function setDateEvaluation(\DateTimeInterface $dateEvaluation): self
    {
        $this->dateEvaluation = $dateEvaluation;
        return $this;
    }
}
