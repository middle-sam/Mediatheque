<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200710124219 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE book (id INT NOT NULL, pages INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cd (id INT NOT NULL, plages INT NOT NULL, duration TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dvd (id INT NOT NULL, duration TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ebook (id INT NOT NULL, pages INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE newspaper (id INT NOT NULL, periodicity VARCHAR(100) NOT NULL, subscription_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331BF396750 FOREIGN KEY (id) REFERENCES documents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cd ADD CONSTRAINT FK_45D68FDABF396750 FOREIGN KEY (id) REFERENCES documents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dvd ADD CONSTRAINT FK_8325C1DFBF396750 FOREIGN KEY (id) REFERENCES documents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ebook ADD CONSTRAINT FK_7D51730DBF396750 FOREIGN KEY (id) REFERENCES documents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE newspaper ADD CONSTRAINT FK_C6E2E686BF396750 FOREIGN KEY (id) REFERENCES documents (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE documents DROP duration, DROP pages, DROP periodicity, DROP subscription_date, DROP plages');
        $this->addSql('ALTER TABLE ressources CHANGE title_id title_id INT DEFAULT NULL, CHANGE url url VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE cd');
        $this->addSql('DROP TABLE dvd');
        $this->addSql('DROP TABLE ebook');
        $this->addSql('DROP TABLE newspaper');
        $this->addSql('ALTER TABLE documents ADD duration TIME DEFAULT \'NULL\', ADD pages INT DEFAULT NULL, ADD periodicity VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, ADD subscription_date DATETIME DEFAULT \'NULL\', ADD plages INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ressources CHANGE title_id title_id INT DEFAULT NULL, CHANGE url url VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
