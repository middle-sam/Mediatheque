<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200710141320 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE borrowing (id INT AUTO_INCREMENT NOT NULL, member_id_id INT NOT NULL, start_date DATETIME NOT NULL, expected_return_date DATETIME NOT NULL, effective_return_date DATETIME DEFAULT NULL, INDEX IDX_226E58971D650BA4 (member_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creator (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birth_date DATE NOT NULL, death_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee (id INT NOT NULL, phone_number VARCHAR(20) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE is_involved_in (id INT AUTO_INCREMENT NOT NULL, creator_id_id INT NOT NULL, role VARCHAR(255) NOT NULL, INDEX IDX_D90AEDB7F05788E9 (creator_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maintenance (id INT AUTO_INCREMENT NOT NULL, employee_id_id INT NOT NULL, maintenance_date DATETIME NOT NULL, status TINYINT(1) NOT NULL, creator VARCHAR(255) NOT NULL, INDEX IDX_2F84F8E99749932E (employee_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meet_up (id INT AUTO_INCREMENT NOT NULL, emplyoyee_id_id INT NOT NULL, creator_id_id INT NOT NULL, employee_id_id INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_FF163646F6590200 (emplyoyee_id_id), UNIQUE INDEX UNIQ_FF163646F05788E9 (creator_id_id), INDEX IDX_FF1636469749932E (employee_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member (id INT NOT NULL, membership_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participates (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, meet_up_id_id INT DEFAULT NULL, places INT NOT NULL, INDEX IDX_330175249D86650F (user_id_id), INDEX IDX_33017524C9F6EA32 (meet_up_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE borrowing ADD CONSTRAINT FK_226E58971D650BA4 FOREIGN KEY (member_id_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE is_involved_in ADD CONSTRAINT FK_D90AEDB7F05788E9 FOREIGN KEY (creator_id_id) REFERENCES creator (id)');
        $this->addSql('ALTER TABLE maintenance ADD CONSTRAINT FK_2F84F8E99749932E FOREIGN KEY (employee_id_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE meet_up ADD CONSTRAINT FK_FF163646F6590200 FOREIGN KEY (emplyoyee_id_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE meet_up ADD CONSTRAINT FK_FF163646F05788E9 FOREIGN KEY (creator_id_id) REFERENCES creator (id)');
        $this->addSql('ALTER TABLE meet_up ADD CONSTRAINT FK_FF1636469749932E FOREIGN KEY (employee_id_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participates ADD CONSTRAINT FK_330175249D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE participates ADD CONSTRAINT FK_33017524C9F6EA32 FOREIGN KEY (meet_up_id_id) REFERENCES meet_up (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE is_involved_in DROP FOREIGN KEY FK_D90AEDB7F05788E9');
        $this->addSql('ALTER TABLE meet_up DROP FOREIGN KEY FK_FF163646F05788E9');
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A1BF396750');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78BF396750');
        $this->addSql('ALTER TABLE participates DROP FOREIGN KEY FK_330175249D86650F');
        $this->addSql('ALTER TABLE maintenance DROP FOREIGN KEY FK_2F84F8E99749932E');
        $this->addSql('ALTER TABLE meet_up DROP FOREIGN KEY FK_FF163646F6590200');
        $this->addSql('ALTER TABLE meet_up DROP FOREIGN KEY FK_FF1636469749932E');
        $this->addSql('ALTER TABLE participates DROP FOREIGN KEY FK_33017524C9F6EA32');
        $this->addSql('ALTER TABLE borrowing DROP FOREIGN KEY FK_226E58971D650BA4');
        $this->addSql('DROP TABLE borrowing');
        $this->addSql('DROP TABLE creator');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE is_involved_in');
        $this->addSql('DROP TABLE maintenance');
        $this->addSql('DROP TABLE meet_up');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE participates');
    }
}
