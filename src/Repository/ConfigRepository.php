<?php

namespace App\Repository;

use App\Entity\Config;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Config|null find($id, $lockMode = null, $lockVersion = null)
 * @method Config|null findOneBy(array $criteria, array $orderBy = null)
 * @method Config[]    findAll()
 * @method Config[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Config::class);
    }

    /**
     * Je récupère une configuration par son nom.
     * Cette méthode retourne la valeur de la configuration demandée ou null si elle n'existe pas.
     *
     * @param string $name Le nom de la configuration
     * @return string|null La valeur de la configuration ou null
     */
    public function getValueByName(string $name): ?string
    {
        $config = $this->findOneBy(['name' => $name]);

        return $config ? $config->getValue() : null;
    }

    /**
     * Je sauvegarde ou je mets à jour une configuration.
     * Si la configuration avec le nom spécifié existe déjà, sa valeur sera mise à jour.
     * Sinon, une nouvelle configuration sera créée.
     *
     * @param string $name Le nom de la configuration
     * @param string $value La nouvelle valeur de la configuration
     */
    public function setValueByName(string $name, string $value): void
    {
        $entityManager = $this->getEntityManager();
        $config = $this->findOneBy(['name' => $name]);

        if (!$config) {
            $config = new Config();
            $config->setName($name);
        }

        $config->setValue($value);
        $entityManager->persist($config);
        $entityManager->flush();
    }

    /**
     * Je récupère toutes les configurations sous forme de tableau associatif.
     * La clé est le nom de la configuration et la valeur est la valeur de la configuration.
     *
     * @return array Un tableau associatif des configurations
     */
    public function findAllAsArray(): array
    {
        $configs = $this->findAll();
        $result = [];

        foreach ($configs as $config) {
            $result[$config->getName()] = $config->getValue();
        }

        return $result;
    }
}
