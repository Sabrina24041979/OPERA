<?php

namespace App\Command;

use App\Entity\Personal;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppHashPasswordCommand extends Command
{
    protected static $defaultName = 'app:created-user';
    
    private $entityManager;
    private $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    protected function configure(): void
    {
        $this
        ->setName('app:hash-password')
            ->setDescription('Hashes the passwords of the Personal entities.')
            ->setHelp('This command allows you to hash all passwords of Personal entities...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $repository = $this->entityManager->getRepository(Personal::class);
        $personals = $repository->findAll();

        foreach ($personals as $personal) {
            if ($personal->getPassword() && !$this->isPasswordHashed($personal->getPassword())) {
                $hashedPassword = $this->passwordHasher->hashPassword($personal, $personal->getPassword());
                $personal->setPassword($hashedPassword);
                $this->entityManager->persist($personal);
            }
        }

        $this->entityManager->flush();
        $output->writeln('All passwords have been hashed.');

        return Command::SUCCESS;
    }

    private function isPasswordHashed($password): bool
    {
        return strpos($password, '$') === 0;
    }
}
