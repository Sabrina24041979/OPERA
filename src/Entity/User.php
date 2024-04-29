<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Post; // Assurez-vous que cette classe existe et est correctement définie.
use App\Entity\Task;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: "users")]
#[UniqueEntity(fields: ["email"], message: "L'email que vous avez indiqué est déjà utilisé.")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 180, unique: true)]
    #[Assert\NotBlank(message: "L'email ne peut pas être vide.")]
    #[Assert\Email(message: "Le format de l'adresse email n'est pas valide.")]
    private string $email;

    #[ORM\Column(type: "json")]
    private array $roles = [];

    #[ORM\Column(type: "string")]
    #[Assert\NotBlank]
    private string $password;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private string $name;

    // #[ORM\OneToMany(mappedBy: "user", targetEntity: Post::class, orphanRemoval: true)]
    // private Collection $posts;

    #[ORM\OneToMany(mappedBy: "user", targetEntity: Task::class, cascade: ["persist", "remove"])]
    private Collection $tasks;

    public function __construct()
    {
        // $this->posts = new ArrayCollection();
        $this->tasks = new ArrayCollection();
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
        return array_unique(array_merge($this->roles, ['ROLE_USER']));
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
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    public function eraseCredentials() { }

    public function getUserIdentifier(): string
    {
        return $this->email;
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
        if ($this->tasks->removeElement($task) && $task->getUser() === $this) {
            $task->setUser(null);
        }
        return $this;
    }

    // public function getPosts(): Collection
    // {
    //     return $this->posts;
    // }

    // public function addPost(Post $post): self
    // {
    //     if (!$this->posts->contains($post)) {
    //         $this->posts[] = $post;
    //         post->setUser($this);
    //     }
    //     return $this;
    // }

    // public function removePost(Post $post): self
    // {
    //     if ($this->posts->removeElement($post) && $post->getUser() === $this) {
    //         $post->setUser(null);
    //     }
    //     return $this;
    // }
}
