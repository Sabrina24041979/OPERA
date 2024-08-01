<?php

namespace App\DataFixtures;

use App\Entity\Personal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IntervieweeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Noms d'interviewees pour des données plus réalistes
        $names = [
            'Djamil Sané', 'Kemarha Chit', 'Fabien Charrin', 'Océanne Lao', 'Yacine Yacoubi',
            'Timothée Decool', 'Lucas Berthet', 'Eroudini Abdullatif', 'Roman Roro', 'Diégo Didi'
        ];

        foreach ($names as $index => $name) {
            $interviewee = new Personal();
            $interviewee->setName($name);
            $interviewee->setEmail(strtolower(str_replace(' ', '', $name)) . '@example.com');
            // Pour ajouter des positions, assurez-vous que votre entité Personal a un attribut 'position'
            // $interviewee->setPosition('Employee');

            $manager->persist($interviewee);
        }

        $manager->flush();
    }
}
