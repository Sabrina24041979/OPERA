<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PerformanceReviewRepository;

/**
 * @ORM\Entity(repositoryClass=PerformanceReviewRepository::class)
 */
class PerformanceReview
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="text")
     */
    private string $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $reviewDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Admin", inversedBy="performanceReviews")
     * @ORM\JoinColumn(nullable=false)
     */
    private Admin $admin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $reviewedUser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getReviewDate(): \DateTimeInterface
    {
        return $this->reviewDate;
    }

    public function setReviewDate(\DateTimeInterface $reviewDate): self
    {
        $this->reviewDate = $reviewDate;
        return $this;
    }

    public function getAdmin(): Admin
    {
        return $this->admin;
    }

    public function setAdmin(Admin $admin): self
    {
        $this->admin = $admin;
        return $this;
    }

    public function getReviewedUser(): User
    {
        return $this->reviewedUser;
    }

    public function setReviewedUser(User $reviewedUser): self
    {
        $this->reviewedUser = $reviewedUser;
        return $this;
    }
}
