<?php

namespace App\Service;

use App\Repository\ConfigRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Config;

class ConfigService
{
    private $configRepository;
    private $entityManager;

    // Je déclare les dépendances dont j'ai besoin : ConfigRepository pour les requêtes et EntityManager pour la persistance
    public function __construct(ConfigRepository $configRepository, EntityManagerInterface $entityManager)
    {
        $this->configRepository = $configRepository;
        $this->entityManager = $entityManager;
    }

    // Je récupère une configuration par son nom
    public function get(string $name)
    {
        $config = $this->configRepository->findOneBy(['name' => $name]);
        return $config ? $config->getValue() : null;
    }

    // Je sauvegarde ou mets à jour une configuration
    public function set(string $name, string $value)
    {
        $config = $this->configRepository->findOneBy(['name' => $name]);

        if (!$config) {
            // Si la configuration n'existe pas, je crée une nouvelle entité Config
            $config = new Config();
            $config->setName($name);
        }

        // Je mets à jour la valeur et je sauvegarde les changements
        $config->setValue($value);
        $this->entityManager->persist($config);
        $this->entityManager->flush();
    }
}