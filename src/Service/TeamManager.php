<?php

namespace App\Service;

use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Je gère les opérations liées aux équipes pour l'application OPERA.
 */
class TeamManager
{
    private $entityManager;
    private $teamRepository;

    /**
     * Le constructeur injecte les dépendances nécessaires.
     */
    public function __construct(EntityManagerInterface $entityManager, TeamRepository $teamRepository)
    {
        $this->entityManager = $entityManager;
        $this->teamRepository = $teamRepository;
    }

    /**
     * Je crée une nouvelle équipe et la sauvegarde en base de données.
     */
    public function createTeam(string $name, array $members): Team
    {
        $team = new Team();
        $team->setName($name);
        foreach ($members as $member) {
            $team->addMember($member);
        }

        $this->entityManager->persist($team);
        $this->entityManager->flush();

        return $team;
    }

    /**
     * Je modifie les données d'une équipe existante.
     */
    public function updateTeam(Team $team, string $name, array $newMembers = null): Team
    {
        $team->setName($name);
        if ($newMembers !== null) {
            foreach ($team->getMembers() as $member) {
                $team->removeMember($member);
            }
            foreach ($newMembers as $member) {
                $team->addMember($member);
            }
        }

        $this->entityManager->flush();

        return $team;
    }

    /**
     * Je supprime une équipe de la base de données.
     */
    public function deleteTeam(Team $team)
    {
        $this->entityManager->remove($team);
        $this->entityManager->flush();
    }

    /**
     * Je récupère toutes les équipes disponibles.
     */
    public function getAllTeams(): array
    {
        return $this->teamRepository->findAll();
    }

    /**
     * Je récupère une équipe par son identifiant.
     */
    public function getTeamById($id): ?Team
    {
        return $this->teamRepository->find($id);
    }
}
