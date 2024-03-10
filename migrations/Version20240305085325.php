<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305085325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile DROP INDEX IDX_8157AA0F5D430949, ADD UNIQUE INDEX UNIQ_8157AA0F5D430949 (personal_id)');
        $this->addSql('ALTER TABLE profile ADD username VARCHAR(255) NOT NULL, DROP fullname, CHANGE personal_id personal_id INT NOT NULL, CHANGE lastname lastname VARCHAR(255) NOT NULL, CHANGE firstname firstname VARCHAR(255) NOT NULL, CHANGE position position VARCHAR(255) NOT NULL, CHANGE birthdate birthdate DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profile DROP INDEX UNIQ_8157AA0F5D430949, ADD INDEX IDX_8157AA0F5D430949 (personal_id)');
        $this->addSql('ALTER TABLE profile ADD fullname VARCHAR(255) DEFAULT NULL, DROP username, CHANGE personal_id personal_id INT DEFAULT NULL, CHANGE firstname firstname VARCHAR(255) DEFAULT NULL, CHANGE lastname lastname VARCHAR(255) DEFAULT NULL, CHANGE position position VARCHAR(255) DEFAULT NULL, CHANGE birthdate birthdate DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\'');
    }
}
