<?php

namespace App\Entity;

use App\Entity\Manager;
use App\Entity\Personal;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TeamRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $team_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $team_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $member = null;

    #[ORM\OneToMany(targetEntity: TeamMember::class, mappedBy: 'team')]
    private Collection $teamMembers;

    #[ORM\ManyToOne(targetEntity: Manager::class, inversedBy: "teams")]
    #[ORM\JoinColumn(nullable: false)]
    private $manager;

    #[ORM\ManyToMany(targetEntity: Personal::class, inversedBy: "teams")]
    private Collection $members;

    public function __construct()
    {
        $this->teamMembers = new ArrayCollection();
        $this->members = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamId(): ?int
    {
        return $this->team_id;
    }

    public function setTeamId(?int $team_id): static
    {
        $this->team_id = $team_id;

        return $this;
    }

    public function getTeamName(): ?string
    {
        return $this->team_name;
    }

    public function setTeamName(?string $team_name): static
    {
        $this->team_name = $team_name;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getMember(): ?string
    {
        return $this->member;
    }

    public function setMember(?string $member): static
    {
        $this->member = $member;

        return $this;
    }

    /**
     * @return Collection<int, TeamMember>
     */
    public function getTeamMembers(): Collection
    {
        return $this->teamMembers;
    }

    public function addTeamMember(TeamMember $teamMember): self
    {
        if (!$this->teamMembers->contains($teamMember)) {
            $this->teamMembers->add($teamMember);
            $teamMember->setTeam($this);
        }

        return $this;
    }

    public function removeTeamMember(TeamMember $teamMember): static
    {
        if ($this->teamMembers->removeElement($teamMember)) {
            // set the owning side to null (unless already changed)
            if ($teamMember->getTeam() === $this) {
                $teamMember->setTeam(null);
            }
        }

        return $this;
    }
    public function getManager(): ?Manager
    {
        return $this->manager;
    }

    public function setManager(?Manager $manager): self
    {
        $this->manager = $manager;

        return $this;
    }

    public function addMember(Personal $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
        }

        return $this;
    }

    public function removeMember(Personal $member): self
    {
        $this->members->removeElement($member);

        return $this;
    }

    /**
     * @return Collection|Personal[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }
}
