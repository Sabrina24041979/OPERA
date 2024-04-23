<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass:"App\Repository\UserRepository")]
#[ORM\Table(name:"users")]
#[UniqueEntity(fields:"email", message:"L'email que vous avez indiqué est déjà utilisé.")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type:"string", length:180, unique:true)]
    #[Assert\NotBlank(message:"L'email ne peut pas être vide.")]
    #[Assert\Email(message:"Le format de l'adresse email n'est pas valide.")]
    #[Assert\Length(
        min: 8,
        max: 4096,
        minMessage: "Votre mot de passe doit contenir au moins 8 caractères",
        maxMessage: "Votre mot de passe ne peut pas contenir plus de 4096 caractères"
    )]
    #[Assert\Regex(
        pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        message: "Le mot de passe doit contenir au moins un chiffre, une majuscule, une minuscule et un caractère spécial."
    )]
    private string $email;

    #[ORM\Column(type:"json")]
    private array $roles = [];

    /** @var string The hashed password */
    #[ORM\Column(type:"string")]
    private string $password;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\OneToMany(mappedBy: "user", targetEntity: Post::class)]
    private Collection $posts;

    #[ORM\OneToMany(mappedBy: "user", targetEntity: "App\Entity\Task", cascade: ["persist", "remove"])]
    private Collection $tasks;

    #[ORM\Column(type:"string", length:100, nullable:true)]
    private ?string $totpSecret = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?DateTimeInterface $lastLogin = null;

    #[ORM\Column(type: "integer")]
    private $loginAttempts = 0;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?DateTimeInterface $lockoutTime = null;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
        $this->posts = new ArrayCollection(); // Initialisation for posts
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getTotpSecret(): ?string
    {
        return $this->totpSecret;
    }

    public function setTotpSecret(?string $totpSecret): self
    {
        $this->totpSecret = $totpSecret;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setUser($this);
        }
        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->removeElement($task)) {
            if ($task->getUser() === $this) {
                $task->setUser(null);
            }
        }
        return $this;
    }

    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setUser($this);
        }
        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            if ($post->getUser() === $this) {
                $post->setUser(null);
            }
        }
        return $this;
    }

    public function getLastLogin(): ?DateTimeInterface
    {
        return $this->lastLogin;
    }

    public function setLastLogin(DateTimeInterface $lastLogin): self
    {
        $this->lastLogin = $lastLogin;
        return $this;
    }

    public function setLoginAttempts(int $loginAttempts): self
{
    $this->loginAttempts = $loginAttempts;
    return $this;
}

    public function getLockoutTime(): ?DateTimeInterface
    {
        return $this->lockoutTime;
    }

    public function setLockoutTime(?DateTimeInterface $lockoutTime): self
    {
        $this->lockoutTime = $lockoutTime;
        return $this;
    }
}
