<?php

namespace App\DataFixtures;

use App\Entity\Feedback;
use App\Repository\InterviewRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FeedbackFixtures extends Fixture implements DependentFixtureInterface
{
    private InterviewRepository $interviewRepository;

    public function __construct(InterviewRepository $interviewRepository)
    {
        $this->interviewRepository = $interviewRepository;
    }

    public function load(ObjectManager $manager): void
    {
        // Récupération de quelques entretiens pour créer des feedbacks
        $interviews = $this->interviewRepository->findAll();

        foreach ($interviews as $interview) {
            $feedback = new Feedback();
            $feedback->setFeedbackText('Feedback text pour l\'entretien' . $interview->getId());
            $feedback->setDate(new \DateTimeImmutable('now'));
            $feedback->setType('Type de feedback');
            $feedback->setInterview($interview);

            $manager->persist($feedback);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            InterviewFixtures::class,
        ];
    }
}