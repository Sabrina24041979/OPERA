<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240729094750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personal ADD first_connexion DATETIME DEFAULT NULL, ADD type_contract VARCHAR(50) NOT NULL, ADD status VARCHAR(255) NOT NULL, ADD spc VARCHAR(255) NOT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE type_interview ADD interval_date VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personal DROP first_connexion, DROP type_contract, DROP status, DROP spc, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE type_interview DROP interval_date');
        $this->addSql('ALTER TABLE users CHANGE roles roles JSON NOT NULL');
    }
}
