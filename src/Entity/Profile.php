<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

// J'assure que ma classe Profile est bien mappée comme une entité Doctrine.
#[ORM\Entity(repositoryClass: ProfileRepository::class)]
class Profile
{
    // Je définis l'identifiant unique pour chaque profil.
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Les attributs suivants représentent les diverses informations d'un profil.
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $username = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $position = null;

    // Je choisis le type DATETIME_MUTABLE pour la date de naissance pour permettre des modifications.
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $birthdate = null;

    // Le champ pour la photo de profil peut être nul si l'utilisateur ne souhaite pas en ajouter une.
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profilePicture = null;

    // Chaque profil est associé à un utilisateur. L'association est unidirectionnelle ici, depuis le profil vers l'utilisateur.
    #[ORM\OneToOne(inversedBy: 'profile', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Personal $personal = null;

    #[ORM\ManyToOne(targetEntity: Manager::class, inversedBy: "profiles")]
    #[ORM\JoinColumn(nullable: false)]


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): self
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    public function getPersonal(): ?Personal
    {
        return $this->personal;
    }

    public function setPersonal(?Personal $personal): self
    {
        $this->personal = $personal;

        return $this;
    }
    
    private $manager;

    public function getManager(): ?Manager
    {
        return $this->manager;
    }

    public function setManager(?Manager $manager): self
    {
        $this->manager = $manager;

        return $this;
    }
}
