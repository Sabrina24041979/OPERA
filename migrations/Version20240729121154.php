<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240729121154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee_sentiments DROP category, DROP intensity, DROP manager');
        $this->addSql('ALTER TABLE type_interview CHANGE isAutomatic is_automatic TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE workload CHANGE workload_level workload_level INT DEFAULT NULL, CHANGE hours hours INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employee_sentiments ADD category VARCHAR(255) DEFAULT NULL, ADD intensity VARCHAR(255) DEFAULT NULL, ADD manager VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE type_interview CHANGE is_automatic isAutomatic TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE workload CHANGE workload_level workload_level VARCHAR(255) DEFAULT NULL, CHANGE hours hours VARCHAR(255) DEFAULT NULL');
    }
}
