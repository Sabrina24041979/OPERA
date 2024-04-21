<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240421150231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE interview CHANGE interviewer_id interviewer_id INT NOT NULL, CHANGE interviewee_id interviewee_id INT NOT NULL');
        $this->addSql('ALTER TABLE post CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE task ADD user_id INT NOT NULL, ADD name VARCHAR(255) NOT NULL, DROP completed, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_527EDB25A76ED395 ON task (user_id)');
        $this->addSql('ALTER TABLE users CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE interview CHANGE interviewer_id interviewer_id INT DEFAULT NULL, CHANGE interviewee_id interviewee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post CHANGE user_id user_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25A76ED395');
        $this->addSql('DROP INDEX IDX_527EDB25A76ED395 ON task');
        $this->addSql('ALTER TABLE task ADD completed TINYINT(1) NOT NULL, DROP user_id, DROP name, CHANGE id id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE id id VARCHAR(255) NOT NULL');
    }
}
