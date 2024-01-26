<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123153147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce ADD type_bien_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E595B4D7FA FOREIGN KEY (type_bien_id) REFERENCES type_de_bien (id)');
        $this->addSql('CREATE INDEX IDX_F65593E595B4D7FA ON annonce (type_bien_id)');
        $this->addSql('ALTER TABLE type_de_bien DROP FOREIGN KEY FK_4C6702148805AB2F');
        $this->addSql('DROP INDEX IDX_4C6702148805AB2F ON type_de_bien');
        $this->addSql('ALTER TABLE type_de_bien DROP annonce_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E595B4D7FA');
        $this->addSql('DROP INDEX IDX_F65593E595B4D7FA ON annonce');
        $this->addSql('ALTER TABLE annonce DROP type_bien_id');
        $this->addSql('ALTER TABLE type_de_bien ADD annonce_id INT NOT NULL');
        $this->addSql('ALTER TABLE type_de_bien ADD CONSTRAINT FK_4C6702148805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('CREATE INDEX IDX_4C6702148805AB2F ON type_de_bien (annonce_id)');
    }
}
