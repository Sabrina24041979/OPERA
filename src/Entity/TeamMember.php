<?php

namespace App\Entity;

use App\Repository\TeamMemberRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamMemberRepository::class)]
class TeamMember
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $role_in_team = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $joined_at = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleInTeam(): ?string
    {
        return $this->role_in_team;
    }

    public function setRoleInTeam(?string $role_in_team): static
    {
        $this->role_in_team = $role_in_team;

        return $this;
    }

    public function getJoinedAt(): ?\DateTimeInterface
    {
        return $this->joined_at;
    }

    public function setJoinedAt(\DateTimeInterface $joined_at): static
    {
        $this->joined_at = $joined_at;

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
}
