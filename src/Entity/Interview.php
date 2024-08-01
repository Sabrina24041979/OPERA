<?php

namespace App\Entity;

use App\Repository\InterviewRepository;
use DateInterval;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: InterviewRepository::class)]
class Interview
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    // #[Assert\DateTime]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    // #[Assert\NotBlank]
    private ?string $status = null;

    #[ORM\OneToOne(mappedBy: 'interview', cascade: ['persist', 'remove'])]
    private ?Feedback $feedback = null;

    #[ORM\ManyToOne(targetEntity: Personal::class, inversedBy: "interviewsAsInterviewer")]
    #[ORM\JoinColumn()]
    private ?Personal $interviewer;

    #[ORM\ManyToOne(targetEntity: Personal::class, inversedBy: "interviewsAsInterviewee")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Personal $interviewee;

    #[ORM\ManyToOne(inversedBy: 'interviews')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeInterview $typeInterview = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Goal>
     */
    #[ORM\OneToMany(targetEntity: Goal::class, mappedBy: 'interview')]
    private Collection $goals;

    public function __construct()
    {
        $this->goals = new ArrayCollection();
    }

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

    public function getInterviewee(): ?Personal
    {
        return $this->interviewee;
    }

    public function setInterviewee(?Personal $interviewee): static
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
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Goal>
     */
    public function getGoals(): Collection
    {
        return $this->goals;
    }

    public function addGoal(Goal $goal): static
    {
        if (!$this->goals->contains($goal)) {
            $this->goals->add($goal);
            $goal->setInterview($this);
        }

        return $this;
    }

    public function removeGoal(Goal $goal): static
    {
        if ($this->goals->removeElement($goal)) {
            // set the owning side to null (unless already changed)
            if ($goal->getInterview() === $this) {
                $goal->setInterview(null);
            }
        }

        return $this;
    }

    //fct calculating end time of interview with TypeInterview duration
    public function getEndDate(): ?\DateTimeInterface
    {
        //verif si date est défini et si la durée selon le type d'interview est non null
        if ($this->getDate() && $this->getTypeInterview()->getDuration() !== null) {
            //clone de l'objet date de début pour pas le modifier
            $endDate = clone $this->getDate();

            //a cet objet je lui rajoute la durée en minutes pour avoir date de fin
            return $endDate->modify('+' . $this->getTypeInterview()->getDuration() . ' minutes');
        }

        return null;
    }
}
