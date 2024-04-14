<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240328123138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE config (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, sujet VARCHAR(255) NOT NULL, appreciation LONGTEXT NOT NULL, date_realisation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performance (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_evaluation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE action CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE goal CHANGE personal_id personal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE interview CHANGE title title VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE personal ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', DROP role');
        $this->addSql('ALTER TABLE profile CHANGE birthdate birthdate DATETIME NOT NULL');
        $this->addSql('ALTER TABLE team_member CHANGE name name VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE workload CHANGE description description VARCHAR(255) NOT NULL, CHANGE hours hours VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE config');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE performance');
        $this->addSql('ALTER TABLE action CHANGE name name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE goal CHANGE personal_id personal_id INT NOT NULL');
        $this->addSql('ALTER TABLE interview CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE personal ADD role VARCHAR(255) DEFAULT NULL, DROP roles');
        $this->addSql('ALTER TABLE profile CHANGE birthdate birthdate DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE team_member CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE workload CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE hours hours VARCHAR(255) DEFAULT NULL');
    }
}
