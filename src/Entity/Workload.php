<?php

namespace App\Entity;

use App\Repository\WorkloadRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkloadRepository::class)]
class Workload
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $workload_level = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $comment = null;

    #[ORM\ManyToOne(targetEntity: Personal::class, inversedBy: 'workloads')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Personal $personal = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $hours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorkloadLevel(): ?string
    {
        return $this->workload_level;
    }

    public function setWorkloadLevel(?string $workload_level): self
    {
        $this->workload_level = $workload_level;
        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    public function getPersonal(): ?Personal
    {
        return $this->personal;
    }

    public function setPersonal(?Personal $personal): self
    {
        $this->personal = $personal;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getHours(): ?string
    {
        return $this->hours;
    }

    public function setHours(?string $hours): self
    {
        $this->hours = $hours;
        return $this;
    }
}
