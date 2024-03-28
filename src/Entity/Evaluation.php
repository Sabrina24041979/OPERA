<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use Doctrine\ORM\Mapping as ORM;


 #[ORM\Entity(repositoryClass: EvaluationRepository::class)]

class Evaluation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    // J\'utilise une propriété 'sujet' pour identifier le sujet de l\'évaluation.
    private ?string $sujet = null;

    #[ORM\Column(type: "text")]
    //Je stocke une appréciation détaillée pour cette évaluation.
    private ?string $appreciation = null;

    #[ORM\Column(type: "datetime")]
    //La date de réalisation de cette évaluation.
    private ?\DateTimeInterface $dateRealisation = null;

    // Getters et Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;
        return $this;
    }

    public function getAppreciation(): ?string
    {
        return $this->appreciation;
    }

    public function setAppreciation(string $appreciation): self
    {
        $this->appreciation = $appreciation;
        return $this;
    }

    public function getDateRealisation(): ?\DateTimeInterface
    {
        return $this->dateRealisation;
    }

    public function setDateRealisation(\DateTimeInterface $dateRealisation): self
    {
        $this->dateRealisation = $dateRealisation;
        return $this;
    }
}
