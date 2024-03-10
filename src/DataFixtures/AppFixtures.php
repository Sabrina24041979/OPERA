<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Charger les fixtures pour chaque entité
        $this->loadFixture($manager, PersonalFixtures::class);
        $this->loadFixture($manager, ProfileFixtures::class);
        $this->loadFixture($manager, CategoryFixtures::class);
        $this->loadFixture($manager, GoalFixtures::class);
        $this->loadFixture($manager, ActionFixtures::class);
        $this->loadFixture($manager, TeamFixtures::class);
        $this->loadFixture($manager, TeamMemberFixtures::class);
        $this->loadFixture($manager, EmployeeSentimentsFixtures::class);
        $this->loadFixture($manager, InterviewFixtures::class);
        $this->loadFixture($manager, TypeInterviewFixtures::class);
        $this->loadFixture($manager, FeedbackFixtures::class);
        $this->loadFixture($manager, ResourceFixtures::class);
        $this->loadFixture($manager, WorkloadFixtures::class);

        $manager->flush();
    }

    private function loadFixture(ObjectManager $manager, string $className): void
    {
        $fixture = new $className();
        $fixture->load($manager);
    }
}