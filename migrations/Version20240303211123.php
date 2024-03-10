<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240303211123 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE action ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE interview ADD title VARCHAR(255) NOT NULL, ADD description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE team_member ADD name VARCHAR(255) NOT NULL, ADD description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE workload ADD description VARCHAR(255) NOT NULL, ADD hours VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE action DROP name');
        $this->addSql('ALTER TABLE team_member DROP name, DROP description');
        $this->addSql('ALTER TABLE workload DROP description, DROP hours');
        $this->addSql('ALTER TABLE interview DROP title, DROP description');
    }
}
