<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass:"App\Repository\UserRepository")]
#[ORM\Table(name:"users")]
#[UniqueEntity(fields:"email", message:"L'email que vous avez indiqué est déjà utilisé.")]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private $id;

    #[ORM\Column(type:"string", length:180, unique:true)]
    #[Assert\NotBlank(message:"L'email ne peut pas être vide.")]
    #[Assert\Email(message:"Le format de l'adresse email n'est pas valide.")]    

    private $email;

    #[ORM\Column(type:"json")]

    private $roles = [];

    /**
     * @var string Le mot de passe haché*/
    #[ORM\Column(type:"string")]
    private $password;

    /**
     * Je récupère l'identifiant de l'utilisateur.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Je récupère l'email de l'utilisateur.
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Je définis l'email de l'utilisateur.
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Je récupère les rôles de l'utilisateur.
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // garantir toujours au moins un rôle
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * Je définis les rôles de l'utilisateur.
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Je récupère le mot de passe de l'utilisateur.
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Je définis le mot de passe de l'utilisateur.
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Retourne la chaîne de caractères que l'utilisateur utilise pour s'authentifier.
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * Efface les données sensibles de l'utilisateur.
     */
    public function eraseCredentials()
    {
        // Si vous stockez des données temporaires sensibles sur l'utilisateur, effacez-les ici
    }
}
