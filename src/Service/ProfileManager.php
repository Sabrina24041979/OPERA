<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Je gère les opérations liées aux profils utilisateurs pour l'application OPERA.
 */
class ProfileManager
{
    private $entityManager;
    private $userRepository;

    /**
     * Le constructeur injecte les dépendances nécessaires, notamment l'EntityManager et le UserRepository.
     */
    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    }

    /**
     * Je crée un nouveau profil utilisateur et le sauvegarde.
     */
    public function createProfile(string $email, string $name): User
    {
        $user = new User();
        $user->setEmail($email);
        $user->setName($name);
        
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    /**
     * Je mets à jour un profil utilisateur existant.
     */
    public function updateProfile(User $user, string $email, string $name): User
    {
        $user->setEmail($email);
        $user->setName($name);

        $this->entityManager->flush();

        return $user;
    }

    /**
     * Je supprime un profil utilisateur de la base de données.
     */
    public function deleteProfile(User $user)
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    /**
     * Je récupère un profil utilisateur par son identifiant.
     */
    public function getProfileById(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    /**
     * Je récupère tous les profils utilisateurs disponibles.
     */
    public function getAllProfiles(): array
    {
        return $this->userRepository->findAll();
    }
}
