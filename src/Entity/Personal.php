<?php

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

    #[ORM\ManyToMany(targetEntity: Team::class, inversedBy: "members")]
    private Collection $teams;

    #[ORM\ManyToOne(inversedBy: 'personals')]
    private ?Manager $manager = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $firstConnexion = null;

    #[ORM\Column(length: 50)]
    private ?string $type_contract = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    private ?string $SPC = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lastUpdatedPassword = null;


    // #[ORM\Column(type:"string", length:255, nullable:true)]
    // private $position;

    public function __construct()
    {
        $this->goals = new ArrayCollection();
        $this->teamMembers = new ArrayCollection();
        $this->employeeSentiments = new ArrayCollection();
        $this->workloads = new ArrayCollection();
        $this->interviewsAsInterviewer = new ArrayCollection();
        $this->interviewsAsInterviewee = new ArrayCollection();
        $this->teams = new ArrayCollection(); // Initialisation de la collection pour les équipes
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    // Méthodes requises par l'interface UserInterface
    public function getUsername(): ?string
    {
        // Je choisis d'utiliser l'email comme "username" pour l'authentification
        return $this->username;
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

    // public function getPosition(): ?string
    // {
    //     return $this->position;
    // }

    // public function setPosition(?string $position): self
    // {
    //     $this->position = $position;
    //     return $this;
    // }

    public function getPassword(): ?string
    {
        // Je retourne simplement le mot de passe hashé
        return $this->password;
    }

    public function setPassword(?string $password): static
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

    public function getRoles(): array
    {
        // Je m'assure qu'il y a toujours au moins un rôle, 'ROLE_USER' par défaut
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        // Je retourne les rôles de l'utilisateur, assurant qu'il y a toujours au moins 'ROLE_USER'
        return array_unique($this->roles);
    }


    // Méthode pour ajouter un rôle à l'utilisateur
    public function addRole(string $role): self
    {
        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    // Méthode pour retirer un rôle de l'utilisateur
    public function removeRole(string $role): self
    {
        if (($key = array_search($role, $this->roles, true)) !== false) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles); // Je réindexe le tableau après suppression
        }

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
            // set the owning side to null (unless already changed)
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
            // set the owning side to null (unless already changed)
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
            // set the owning side to null (unless already changed)
            if ($workload->getPersonal() === $this) {
                $workload->setPersonal(null);
            }
        }

        return $this;
    }

    /**
    /**
     * @return Collection<int, Interview>
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

    public function setProfile(?Profile $profile): static
    {
        // unset the owning side of the relation if necessary
        if ($profile === null && $this->profile !== null) {
            $this->profile->setPersonal(null);
        }

        // set the owning side of the relation if necessary
        if ($profile !== null && $profile->getPersonal() !== $this) {
            $profile->setPersonal($this);
        }

        $this->profile = $profile;

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

    /**
     * @return Collection<int, Team>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): static
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
        }

        return $this;
    }

    public function removeTeam(Team $team): static
    {
        $this->teams->removeElement($team);

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstConnexion(): ?\DateTimeInterface
    {
        return $this->firstConnexion;
    }

    public function setFirstConnexion(?\DateTimeInterface $firstConnexion): static
    {
        $this->firstConnexion = $firstConnexion;

        return $this;
    }

    public function getTypeContract(): ?string
    {
        return $this->type_contract;
    }

    public function setTypeContract(string $type_contract): static
    {
        $this->type_contract = $type_contract;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getSPC(): ?string
    {
        return $this->SPC;
    }

    public function setSPC(string $SPC): static
    {
        $this->SPC = $SPC;

        return $this;
    }

    public function getLastUpdatedPassword(): ?\DateTimeInterface
    {
        return $this->lastUpdatedPassword;
    }

    public function setLastUpdatedPassword(?\DateTimeInterface $lastUpdatedPassword): static
    {
        $this->lastUpdatedPassword = $lastUpdatedPassword;

        return $this;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function addInterviewsAsInterviewer(Interview $interviewsAsInterviewer): static
    {
        if (!$this->interviewsAsInterviewer->contains($interviewsAsInterviewer)) {
            $this->interviewsAsInterviewer->add($interviewsAsInterviewer);
            $interviewsAsInterviewer->setInterviewer($this);
        }

        return $this;
    }

    public function removeInterviewsAsInterviewer(Interview $interviewsAsInterviewer): static
    {
        if ($this->interviewsAsInterviewer->removeElement($interviewsAsInterviewer)) {
            // set the owning side to null (unless already changed)
            if ($interviewsAsInterviewer->getInterviewer() === $this) {
                $interviewsAsInterviewer->setInterviewer(null);
            }
        }

        return $this;
    }

    public function addInterviewsAsInterviewee(Interview $interviewsAsInterviewee): static
    {
        if (!$this->interviewsAsInterviewee->contains($interviewsAsInterviewee)) {
            $this->interviewsAsInterviewee->add($interviewsAsInterviewee);
            $interviewsAsInterviewee->setInterviewee($this);
        }

        return $this;
    }

    public function removeInterviewsAsInterviewee(Interview $interviewsAsInterviewee): static
    {
        if ($this->interviewsAsInterviewee->removeElement($interviewsAsInterviewee)) {
            // set the owning side to null (unless already changed)
            if ($interviewsAsInterviewee->getInterviewee() === $this) {
                $interviewsAsInterviewee->setInterviewee(null);
            }
        }

        return $this;
    }
}
