<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123081503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_equipement DROP FOREIGN KEY FK_267D0C5F806F0F5C');
        $this->addSql('DROP INDEX IDX_267D0C5F806F0F5C ON categorie_equipement');
        $this->addSql('ALTER TABLE categorie_equipement DROP equipement_id');
        $this->addSql('ALTER TABLE equipement ADD categorie_equipement_id INT NOT NULL');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F383A0EE16 FOREIGN KEY (categorie_equipement_id) REFERENCES categorie_equipement (id)');
        $this->addSql('CREATE INDEX IDX_B8B4C6F383A0EE16 ON equipement (categorie_equipement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie_equipement ADD equipement_id INT NOT NULL');
        $this->addSql('ALTER TABLE categorie_equipement ADD CONSTRAINT FK_267D0C5F806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('CREATE INDEX IDX_267D0C5F806F0F5C ON categorie_equipement (equipement_id)');
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F383A0EE16');
        $this->addSql('DROP INDEX IDX_B8B4C6F383A0EE16 ON equipement');
        $this->addSql('ALTER TABLE equipement DROP categorie_equipement_id');
    }
}
