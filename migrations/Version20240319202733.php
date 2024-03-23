<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319202733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coureur (num_dossard INT NOT NULL, code_pays VARCHAR(3) NOT NULL, code_equipe VARCHAR(3) NOT NULL, resultat_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_de_naissance DATE DEFAULT NULL, INDEX IDX_8CCBA749274566F (code_pays), INDEX IDX_8CCBA7495BCFE2B7 (code_equipe), INDEX IDX_8CCBA749D233E95C (resultat_id), PRIMARY KEY(num_dossard)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (code_equipe VARCHAR(3) NOT NULL, code_pays VARCHAR(3) NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_2449BA15274566F (code_pays), PRIMARY KEY(code_equipe)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etape (num_etape INT AUTO_INCREMENT NOT NULL, ville_depart_id INT NOT NULL, ville_arrive_id INT NOT NULL, resultat_id INT DEFAULT NULL, date DATE NOT NULL, type VARCHAR(255) NOT NULL, distance_parcouru DOUBLE PRECISION NOT NULL, INDEX IDX_285F75DD497832A6 (ville_depart_id), INDEX IDX_285F75DD13784AA5 (ville_arrive_id), INDEX IDX_285F75DDD233E95C (resultat_id), PRIMARY KEY(num_etape)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resultat (id INT AUTO_INCREMENT NOT NULL, temps_parcouru TIME NOT NULL, bonification INT NOT NULL, penalite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coureur ADD CONSTRAINT FK_8CCBA749274566F FOREIGN KEY (code_pays) REFERENCES pays (code_pays)');
        $this->addSql('ALTER TABLE coureur ADD CONSTRAINT FK_8CCBA7495BCFE2B7 FOREIGN KEY (code_equipe) REFERENCES equipe (code_equipe)');
        $this->addSql('ALTER TABLE coureur ADD CONSTRAINT FK_8CCBA749D233E95C FOREIGN KEY (resultat_id) REFERENCES resultat (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15274566F FOREIGN KEY (code_pays) REFERENCES pays (code_pays)');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD497832A6 FOREIGN KEY (ville_depart_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD13784AA5 FOREIGN KEY (ville_arrive_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DDD233E95C FOREIGN KEY (resultat_id) REFERENCES resultat (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coureur DROP FOREIGN KEY FK_8CCBA749274566F');
        $this->addSql('ALTER TABLE coureur DROP FOREIGN KEY FK_8CCBA7495BCFE2B7');
        $this->addSql('ALTER TABLE coureur DROP FOREIGN KEY FK_8CCBA749D233E95C');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15274566F');
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD497832A6');
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD13784AA5');
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DDD233E95C');
        $this->addSql('DROP TABLE coureur');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE resultat');
    }
}
