<?php

namespace App\Entity;

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\PersonalRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


#[ORM\Entity(repositoryClass: PersonalRepository::class)]

class Personal implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // J'inclus toutes les autres propriétés ici
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $username = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $entry_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $exit_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $matricule = null;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(nullable: true)]
    private ?int $manager_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $department = null;

   #[ORM\OneToMany(targetEntity: Goal::class, mappedBy: 'personal')]
    private Collection $goals;

    #[ORM\ManyToMany(targetEntity: TeamMember::class, mappedBy: 'personal')]
    private Collection $teamMembers;

    #[ORM\OneToMany(targetEntity: EmployeeSentiments::class, mappedBy: 'personal', orphanRemoval: true)]
    private Collection $employeeSentiments;

    #[ORM\OneToMany(targetEntity: Workload::class, mappedBy: 'personal')]
    private Collection $workloads;

    #[ORM\OneToMany(targetEntity: Interview::class, mappedBy: 'interviewer')]
    private Collection $interviewsAsInterviewer;

    #[ORM\OneToMany(targetEntity: Interview::class, mappedBy: 'interviewee')]
    private Collection $interviewsAsInterviewee;

    #[ORM\OneToOne(mappedBy: 'personal', cascade: ['persist', 'remove'])]
    private ?Profile $profile = null;

    #[ORM\ManyToOne(inversedBy: 'manager')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Manager $manager = null;

    public function __construct()
    {
        $this->goals = new ArrayCollection();
        $this->teamMembers = new ArrayCollection();
        $this->employeeSentiments = new ArrayCollection();
        $this->workloads = new ArrayCollection();
        $this->interviewsAsInterviewer = new ArrayCollection();
        $this->interviewsAsInterviewee = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    // Méthodes requises par l'interface UserInterface
    public function getUsername(): ?string {
        // Je choisis d'utiliser l'email comme "username" pour l'authentification
        return $this->email;
    }

    public function setUsername(?string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string {
        // Je retourne simplement le mot de passe hashé
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getEntryDate(): ?\DateTimeInterface
    {
        return $this->entry_date;
    }

    public function setEntryDate(?\DateTimeInterface $entry_date): static
    {
        $this->entry_date = $entry_date;

        return $this;
    }

    public function getExitDate(): ?\DateTimeInterface
    {
        return $this->exit_date;
    }

    public function setExitDate(?\DateTimeInterface $exit_date): static
    {
        $this->exit_date = $exit_date;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(?string $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getRoles(): array {
        // Je m'assure qu'il y a toujours au moins un rôle, 'ROLE_USER' par défaut
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        // Je retourne les rôles de l'utilisateur, assurant qu'il y a toujours au moins 'ROLE_USER'
        return array_unique($this->roles);
    }

         // Méthode pour ajouter un rôle à l'utilisateur
     public function addRole(string $role): self {
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    // Méthode pour retirer un rôle de l'utilisateur
    public function removeRole(string $role): self {
        if (($key = array_search($role, $this->roles, true)) !== false) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles); // Je réindexe le tableau après suppression
        }

        return $this;
    }

    public function getManagerId(): ?int
    {
        return $this->manager_id;
    }

    public function setManagerId(?int $manager_id): static
    {
        $this->manager_id = $manager_id;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): static
    {
        $this->department = $department;

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
            $goal->setPersonal($this);
        }

        return $this;
    }

    public function removeGoal(Goal $goal): static
    {
        if ($this->goals->removeElement($goal)) {
            // Je définis le côté propriétaire sur null (sauf s’il a déjà été modifié)
            if ($goal->getPersonal() === $this) {
                $goal->setPersonal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TeamMember>
     */
    public function getTeamMembers(): Collection
    {
        return $this->teamMembers;
    }

    public function addTeamMember(TeamMember $teamMember): static
    {
        if (!$this->teamMembers->contains($teamMember)) {
            $this->teamMembers->add($teamMember);
            $teamMember->addPersonal($this);
        }

        return $this;
    }

    public function removeTeamMember(TeamMember $teamMember): static
    {
        if ($this->teamMembers->removeElement($teamMember)) {
            $teamMember->removePersonal($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, EmployeeSentiments>
     */
    public function getEmployeeSentiments(): Collection
    {
        return $this->employeeSentiments;
    }

    public function addEmployeeSentiment(EmployeeSentiments $employeeSentiment): static
    {
        if (!$this->employeeSentiments->contains($employeeSentiment)) {
            $this->employeeSentiments->add($employeeSentiment);
            $employeeSentiment->setPersonal($this);
        }

        return $this;
    }

    public function removeEmployeeSentiment(EmployeeSentiments $employeeSentiment): static
    {
        if ($this->employeeSentiments->removeElement($employeeSentiment)) {
            // Je définis le côté propriétaire sur null (sauf s’il a déjà été modifié)
            if ($employeeSentiment->getPersonal() === $this) {
                $employeeSentiment->setPersonal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Workload>
     */
    public function getWorkloads(): Collection
    {
        return $this->workloads;
    }

    public function addWorkload(Workload $workload): static
    {
        if (!$this->workloads->contains($workload)) {
            $this->workloads->add($workload);
            $workload->setPersonal($this);
        }

        return $this;
    }

    public function removeWorkload(Workload $workload): static
    {
        if ($this->workloads->removeElement($workload)) {
            // Je définis le côté propriétaire sur null (sauf s’il a déjà été modifié)
            if ($workload->getPersonal() === $this) {
                $workload->setPersonal(null);
            }
        }

        return $this;
    }

   /**
     * @return Collection<int, Interview>
     * J'obtiens la collection des entretiens où la personne est l'interviewer
     */

    public function getInterviewsAsInterviewer(): Collection
    {
        return $this->interviewsAsInterviewer;
    }

    public function addInterviewAsInterviewer(Interview $interview): self
    {
        if (!$this->interviewsAsInterviewer->contains($interview)) {
            $this->interviewsAsInterviewer[] = $interview;
            $interview->setInterviewer($this);
        }

        return $this;
    }

    public function removeInterviewAsInterviewer(Interview $interview): self
    {
        if ($this->interviewsAsInterviewer->removeElement($interview)) {
            // Définit le côté propriétaire sur null (sauf si déjà modifié)
            if ($interview->getInterviewer() === $this) {
                $interview->setInterviewer(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection<int, Interview>
     */
    public function getInterviewsAsInterviewee(): Collection
    {
        return $this->interviewsAsInterviewee;
    }

    public function addInterviewAsInterviewee(Interview $interview): self
    {
        if (!$this->interviewsAsInterviewee->contains($interview)) {
            $this->interviewsAsInterviewee[] = $interview;
            $interview->setInterviewee($this);
        }

        return $this;
    }

    public function removeInterviewAsInterviewee(Interview $interview): self
    {
        if ($this->interviewsAsInterviewee->removeElement($interview) && $interview->getInterviewee() === $this) {
            $interview->setInterviewee(null);
        }

        return $this;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(Profile $profile): static
    {
        // Définir le côté propriétaire de la relation si nécessaire
        if ($profile->getPersonal() !== $this) {
            $profile->setPersonal($this);
        }

        $this->profile = $profile;

        return $this;
    }

    public function getManager(): ?Manager
    {
        return $this->manager;
    }

    public function setManager(?Manager $manager): static
    {
        $this->manager = $manager;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function eraseCredentials()
    {
        // Si vous stockez des données temporaires sensibles sur l'utilisateur, effacez-les ici
    }
}

