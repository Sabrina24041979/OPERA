<?php

namespace App\Entity;

use App\Repository\InterviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterviewRepository::class)]
class Interview
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\OneToOne(mappedBy: 'interview', cascade: ['persist', 'remove'])]
    private ?Feedback $feedback = null;

    #[ORM\ManyToOne(inversedBy: 'interviews')]
    private ?Personal $interviewer = null;

    #[ORM\ManyToOne(inversedBy: 'interviewsAsInterviewee')]
    private ?Personal $interviewee = null;

    #[ORM\ManyToOne(inversedBy: 'interviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeInterview $typeInterview = null;

    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getFeedback(): ?Feedback
    {
        return $this->feedback;
    }

    public function setFeedback(?Feedback $feedback): static
    {
        // unset the owning side of the relation if necessary
        if ($feedback === null && $this->feedback !== null) {
            $this->feedback->setInterview(null);
        }

        // set the owning side of the relation if necessary
        if ($feedback !== null && $feedback->getInterview() !== $this) {
            $feedback->setInterview($this);
        }

        $this->feedback = $feedback;

        return $this;
    }

    public function getInterviewer(): ?Personal
    {
        return $this->interviewer;
    }

    public function setInterviewer(?Personal $interviewer): static
    {
        $this->interviewer = $interviewer;

        return $this;
    }
     // Nouvelles méthodes pour gérer l'interviewé
     public function getInterviewee(): ?Personal
     {
         return $this->interviewee;
     }
 
     public function setInterviewee(?Personal $interviewee): self
     {
         $this->interviewee = $interviewee;
 
         return $this;
     }

     public function getTypeInterview(): ?TypeInterview
     {
         return $this->typeInterview;
     }

     public function setTypeInterview(?TypeInterview $typeInterview): static
     {
         $this->typeInterview = $typeInterview;

         return $this;
     }

     public function getTitle(): ?string
     {
         return $this->Title;
     }

     public function setTitle(string $Title): static
     {
         $this->Title = $Title;

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
}
