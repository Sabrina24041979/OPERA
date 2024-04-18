<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: "App\Repository\UserRepository")]
#[ORM\Table(name: "users")]
#[UniqueEntity(fields: "email", message: "L'email que vous avez indiqué est déjà utilisé.")]
class User implements UserInterface, PasswordAuthenticatedUserInterface // Ajout de TwoFactorInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $id;

    #[ORM\Column(type: "string", length: 180, unique: true)]
    #[Assert\NotBlank(message: "L'email ne peut pas être vide.")]
    #[Assert\Email(message: "Le format de l'adresse email n'est pas valide.")]
    private $email;

    #[ORM\Column(type: "json")]
    private $roles = [];

    /**
     * @var string Le mot de passe haché
     */
    #[ORM\Column(type: "string")]
    private $password;

    // Propriété pour la 2FA
    #[ORM\Column(type: "string", length: 100, nullable: true)]
    private $totpSecret; // Secret pour le TOTP

    // Implémentez les méthodes nécessaires pour TwoFactorInterface
    public function isTotpAuthenticationEnabled(): bool
    {
        return null !== $this->totpSecret;
    }

    public function getTotpAuthenticationUsername(): string
    {
        return $this->email; // Utilisez l'email comme identifiant TOTP
    }

    public function getTotpAuthenticationSecret(): ?string
    {
        return $this->totpSecret;
    }

    public function setTotpAuthenticationSecret(?string $totpSecret): void
    {
        $this->totpSecret = $totpSecret;
    }

    public function getTotpSecret(): ?string {
        return $this->totpSecret;
    }

    public function setTotpSecret(?string $totpSecret): self {
        $this->totpSecret = $totpSecret;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
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
        $roles[] = 'ROLE_USER'; // garantir toujours au moins un rôle
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

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function eraseCredentials()
    {
        // Si vous stockez des données temporaires sensibles sur l'utilisateur, effacez-les ici
    }
}
