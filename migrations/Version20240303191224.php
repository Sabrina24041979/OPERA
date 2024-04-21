<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240303191224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE TABLE action (id INT AUTO_INCREMENT NOT NULL, goal_id INT NOT NULL, description VARCHAR(255) DEFAULT NULL, priority VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, due_date DATETIME DEFAULT NULL, INDEX IDX_47CC8C92667D1AFE (goal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE employee_sentiments (id INT AUTO_INCREMENT NOT NULL, personal_id INT NOT NULL, sentiment_value VARCHAR(255) DEFAULT NULL, date DATETIME DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, intensity VARCHAR(255) DEFAULT NULL, INDEX IDX_2F26F4625D430949 (personal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE feedback (id INT AUTO_INCREMENT NOT NULL, interview_id INT DEFAULT NULL, feedback_text VARCHAR(255) DEFAULT NULL, date DATETIME DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_D229445855D69D95 (interview_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // // $this->addSql('CREATE TABLE goal (id INT AUTO_INCREMENT NOT NULL, personal_id INT DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, deadline DATETIME DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, priority VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_FCDCEB2E5D430949 (personal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE interview (id INT AUTO_INCREMENT NOT NULL, interviewer_id INT DEFAULT NULL, interviewee_id INT DEFAULT NULL, type_interview_id INT NOT NULL, date DATETIME DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_CF1D3C347906D9E8 (interviewer_id), INDEX IDX_CF1D3C34B4C8B6CE (interviewee_id), INDEX IDX_CF1D3C34D2952790 (type_interview_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE personal (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, entry_date DATETIME DEFAULT NULL, exit_date DATETIME DEFAULT NULL, matricule VARCHAR(255) DEFAULT NULL, role VARCHAR(255) DEFAULT NULL, manager_id INT DEFAULT NULL, department VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, personal_id INT DEFAULT NULL, fullname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, position VARCHAR(255) DEFAULT NULL, birthdate DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', profile_picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8157AA0F5D430949 (personal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE resource (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, file_path VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, personal INT DEFAULT NULL, INDEX IDX_BC91F41612469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, team_id INT DEFAULT NULL, team_name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL, member VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE team_member (id INT AUTO_INCREMENT NOT NULL, team_id INT NOT NULL, role_in_team VARCHAR(255) DEFAULT NULL, joined_at DATETIME NOT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_6FFBDA1296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE team_member_personal (team_member_id INT NOT NULL, personal_id INT NOT NULL, INDEX IDX_2509D410C292CD19 (team_member_id), INDEX IDX_2509D4105D430949 (personal_id), PRIMARY KEY(team_member_id, personal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE type_interview (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE workload (id INT AUTO_INCREMENT NOT NULL, personal_id INT NOT NULL, workload_level VARCHAR(255) DEFAULT NULL, date DATETIME DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, INDEX IDX_1203AA7B5D430949 (personal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C92667D1AFE FOREIGN KEY (goal_id) REFERENCES goal (id)');
        // $this->addSql('ALTER TABLE employee_sentiments ADD CONSTRAINT FK_2F26F4625D430949 FOREIGN KEY (personal_id) REFERENCES personal (id)');
        // $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D229445855D69D95 FOREIGN KEY (interview_id) REFERENCES interview (id)');
        // $this->addSql('ALTER TABLE goal ADD CONSTRAINT FK_FCDCEB2E5D430949 FOREIGN KEY (personal_id) REFERENCES personal (id)');
        // $this->addSql('ALTER TABLE interview ADD CONSTRAINT FK_CF1D3C347906D9E8 FOREIGN KEY (interviewer_id) REFERENCES personal (id)');
        // $this->addSql('ALTER TABLE interview ADD CONSTRAINT FK_CF1D3C34B4C8B6CE FOREIGN KEY (interviewee_id) REFERENCES personal (id)');
        // $this->addSql('ALTER TABLE interview ADD CONSTRAINT FK_CF1D3C34D2952790 FOREIGN KEY (type_interview_id) REFERENCES type_interview (id)');
        // $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F5D430949 FOREIGN KEY (personal_id) REFERENCES personal (id)');
        // $this->addSql('ALTER TABLE resource ADD CONSTRAINT FK_BC91F41612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        // $this->addSql('ALTER TABLE team_member ADD CONSTRAINT FK_6FFBDA1296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        // $this->addSql('ALTER TABLE team_member_personal ADD CONSTRAINT FK_2509D410C292CD19 FOREIGN KEY (team_member_id) REFERENCES team_member (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE team_member_personal ADD CONSTRAINT FK_2509D4105D430949 FOREIGN KEY (personal_id) REFERENCES personal (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE workload ADD CONSTRAINT FK_1203AA7B5D430949 FOREIGN KEY (personal_id) REFERENCES personal (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C92667D1AFE');
        $this->addSql('ALTER TABLE employee_sentiments DROP FOREIGN KEY FK_2F26F4625D430949');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D229445855D69D95');
        $this->addSql('ALTER TABLE goal DROP FOREIGN KEY FK_FCDCEB2E5D430949');
        $this->addSql('ALTER TABLE interview DROP FOREIGN KEY FK_CF1D3C347906D9E8');
        $this->addSql('ALTER TABLE interview DROP FOREIGN KEY FK_CF1D3C34B4C8B6CE');
        $this->addSql('ALTER TABLE interview DROP FOREIGN KEY FK_CF1D3C34D2952790');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F5D430949');
        $this->addSql('ALTER TABLE resource DROP FOREIGN KEY FK_BC91F41612469DE2');
        $this->addSql('ALTER TABLE team_member DROP FOREIGN KEY FK_6FFBDA1296CD8AE');
        $this->addSql('ALTER TABLE team_member_personal DROP FOREIGN KEY FK_2509D410C292CD19');
        $this->addSql('ALTER TABLE team_member_personal DROP FOREIGN KEY FK_2509D4105D430949');
        $this->addSql('ALTER TABLE workload DROP FOREIGN KEY FK_1203AA7B5D430949');
        $this->addSql('DROP TABLE action');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE employee_sentiments');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE goal');
        $this->addSql('DROP TABLE interview');
        $this->addSql('DROP TABLE personal');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE resource');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE team_member');
        $this->addSql('DROP TABLE team_member_personal');
        $this->addSql('DROP TABLE type_interview');
        $this->addSql('DROP TABLE workload');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
