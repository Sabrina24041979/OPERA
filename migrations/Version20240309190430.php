<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240309190430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE resource CHANGE personal personal_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F4165D430949 FOREIGN KEY (personal_id) REFERENCES personal (id)');
        // $this->addSql('CREATE INDEX IDX_BC91F4165D430949 ON resource (personal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resource DROP FOREIGN KEY FK_BC91F4165D430949');
        $this->addSql('DROP INDEX IDX_BC91F4165D430949 ON resource');
        $this->addSql('ALTER TABLE resource CHANGE personal_id personal INT DEFAULT NULL');
    }
}
