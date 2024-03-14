<?php

namespace App\DataFixtures;

use App\Entity\Resource;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ResourceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Création de ressources fictives
        for ($i = 1; $i <= 10; $i++) {
            $resource = new Resource();
            $resource->setTitle('Ressource ' . $i);
            $resource->setDescription('Description de la ressource ' . $i);
            $resource->setFilePath('/path/to/resource_' . $i . '.pdf');
            $resource->setCreatedAt(new \DateTimeImmutable('2024-01-' . ($i < 10 ? '0' . $i : $i)));
            $resource->setUpdatedAt(new \DateTimeImmutable('2024-02-' . ($i < 10 ? '0' . $i : $i)));
            $resource->setCategory($this->getReference("category_" . rand(1,5)));

            // Associer la ressource à une catégorie (à remplacer par la logique appropriée)
            // Exemple: $resource->setCategory($this->getReference('category_' . $i));
            // Assurez-vous que les références de catégorie sont correctement définies dans d'autres fixtures

            // Associer la ressource à un utilisateur (à remplacer par la logique appropriée)
            // Exemple: $resource->setPersonal($this->getReference('user_' . $i));
            // Assurez-vous que les références d'utilisateur sont correctement définies dans d'autres fixtures

            $manager->persist($resource);

            // Ajouter une référence pour la ressource (facultatif, mais utile pour référencer la ressource dans d'autres fixtures)
            $this->addReference('resource_' . $i, $resource);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}