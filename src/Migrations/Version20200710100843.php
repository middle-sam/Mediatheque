<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200710100843 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book ADD cote VARCHAR(255) NOT NULL, ADD titre VARCHAR(255) NOT NULL, ADD format VARCHAR(255) NOT NULL, ADD code_oeuvre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE cd ADD cote VARCHAR(255) NOT NULL, ADD titre VARCHAR(255) NOT NULL, ADD format VARCHAR(255) NOT NULL, ADD code_oeuvre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE dvd ADD cote VARCHAR(255) NOT NULL, ADD titre VARCHAR(255) NOT NULL, ADD format VARCHAR(255) NOT NULL, ADD code_oeuvre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ebook ADD cote VARCHAR(255) NOT NULL, ADD titre VARCHAR(255) NOT NULL, ADD format VARCHAR(255) NOT NULL, ADD code_oeuvre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE newspaper ADD cote VARCHAR(255) NOT NULL, ADD titre VARCHAR(255) NOT NULL, ADD format VARCHAR(255) NOT NULL, ADD code_oeuvre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ressources ADD title_id INT DEFAULT NULL, CHANGE url url VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE ressources ADD CONSTRAINT FK_6A2CD5C7A9F87BD FOREIGN KEY (title_id) REFERENCES documents (id)');
        $this->addSql('CREATE INDEX IDX_6A2CD5C7A9F87BD ON ressources (title_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book DROP cote, DROP titre, DROP format, DROP code_oeuvre');
        $this->addSql('ALTER TABLE cd DROP cote, DROP titre, DROP format, DROP code_oeuvre');
        $this->addSql('ALTER TABLE dvd DROP cote, DROP titre, DROP format, DROP code_oeuvre');
        $this->addSql('ALTER TABLE ebook DROP cote, DROP titre, DROP format, DROP code_oeuvre');
        $this->addSql('ALTER TABLE newspaper DROP cote, DROP titre, DROP format, DROP code_oeuvre');
        $this->addSql('ALTER TABLE ressources DROP FOREIGN KEY FK_6A2CD5C7A9F87BD');
        $this->addSql('DROP INDEX IDX_6A2CD5C7A9F87BD ON ressources');
        $this->addSql('ALTER TABLE ressources DROP title_id, CHANGE url url VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
