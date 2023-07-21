<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230720144833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', content LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employer_commentaire (employer_id INT NOT NULL, commentaire_id INT NOT NULL, INDEX IDX_2FA2094341CD9E7A (employer_id), INDEX IDX_2FA20943BA9CD190 (commentaire_id), PRIMARY KEY(employer_id, commentaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE employer_commentaire ADD CONSTRAINT FK_2FA2094341CD9E7A FOREIGN KEY (employer_id) REFERENCES employer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employer_commentaire ADD CONSTRAINT FK_2FA20943BA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE employer ADD comptes_id INT DEFAULT NULL, CHANGE nom_em nom_em VARCHAR(255) NOT NULL, CHANGE prenom_em prenom_em VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE employer ADD CONSTRAINT FK_DE4CF066DCED588B FOREIGN KEY (comptes_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_DE4CF066DCED588B ON employer (comptes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employer DROP FOREIGN KEY FK_DE4CF066DCED588B');
        $this->addSql('ALTER TABLE employer_commentaire DROP FOREIGN KEY FK_2FA2094341CD9E7A');
        $this->addSql('ALTER TABLE employer_commentaire DROP FOREIGN KEY FK_2FA20943BA9CD190');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE employer_commentaire');
        $this->addSql('DROP INDEX IDX_DE4CF066DCED588B ON employer');
        $this->addSql('ALTER TABLE employer DROP comptes_id, CHANGE nom_em nom_em VARCHAR(200) NOT NULL, CHANGE prenom_em prenom_em VARCHAR(200) NOT NULL, CHANGE email email VARCHAR(50) NOT NULL');
    }
}
