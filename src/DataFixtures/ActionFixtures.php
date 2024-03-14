<?php

namespace App\DataFixtures;

use App\Entity\Action;
use App\Repository\GoalRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ActionFixtures extends Fixture implements DependentFixtureInterface
{
    private GoalRepository $goalRepository;

    public function __construct(GoalRepository $goalRepository)
    {
        $this->goalRepository = $goalRepository;
    }

    public function load(ObjectManager $manager): void
    {
        // Récupération de quelques objectifs pour créer des actions
        $goals = $this->goalRepository->findAll();

        foreach ($goals as $goal) {
            for ($i = 1; $i <= 3; $i++) {
                $action = new Action();
                $action->setName('Action ' . $i);
                $action->setDescription('Description de l\' Action ' . $i);
                $action->setPriority('Haute');
                $action->setStatus('En instance');
                $action->setCreatedAt(new \DateTimeImmutable('now'));
                $action->setUpdatedAt(new \DateTimeImmutable('now'));
                $action->setDueDate(new \DateTimeImmutable('now +1 week'));
                $action->setGoal($goal);

                $manager->persist($action);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            GoalFixtures::class,
        ];
    }
}