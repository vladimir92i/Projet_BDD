<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319215218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etape ADD resultat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DDD233E95C FOREIGN KEY (resultat_id) REFERENCES resultat (id)');
        $this->addSql('CREATE INDEX IDX_285F75DDD233E95C ON etape (resultat_id)');
        $this->addSql('ALTER TABLE resultat ADD num_dossard INT NOT NULL');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE270F9AA1 FOREIGN KEY (num_dossard) REFERENCES coureur (num_dossard)');
        $this->addSql('CREATE INDEX IDX_E7DB5DE270F9AA1 ON resultat (num_dossard)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DDD233E95C');
        $this->addSql('DROP INDEX IDX_285F75DDD233E95C ON etape');
        $this->addSql('ALTER TABLE etape DROP resultat_id');
        $this->addSql('ALTER TABLE resultat DROP FOREIGN KEY FK_E7DB5DE270F9AA1');
        $this->addSql('DROP INDEX IDX_E7DB5DE270F9AA1 ON resultat');
        $this->addSql('ALTER TABLE resultat DROP num_dossard');
    }
}
