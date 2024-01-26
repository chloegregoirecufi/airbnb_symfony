<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122133321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE annonce (id INT AUTO_INCREMENT NOT NULL, image_id INT NOT NULL, address VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, size DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, couchage INT NOT NULL, INDEX IDX_F65593E53DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE annonce_equipement (annonce_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_A6C013708805AB2F (annonce_id), INDEX IDX_A6C01370806F0F5C (equipement_id), PRIMARY KEY(annonce_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_equipement (id INT AUTO_INCREMENT NOT NULL, equipement_id INT NOT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_267D0C5F806F0F5C (equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, imagepath VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, imagepath VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, INDEX IDX_42C849558805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_de_bien (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, label VARCHAR(255) NOT NULL, imagepath VARCHAR(255) NOT NULL, INDEX IDX_4C6702148805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, annonce_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, phone VARCHAR(50) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(50) NOT NULL, codepostale VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6498805AB2F (annonce_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E53DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE annonce_equipement ADD CONSTRAINT FK_A6C013708805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce_equipement ADD CONSTRAINT FK_A6C01370806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE categorie_equipement ADD CONSTRAINT FK_267D0C5F806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849558805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE type_de_bien ADD CONSTRAINT FK_4C6702148805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6498805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E53DA5256D');
        $this->addSql('ALTER TABLE annonce_equipement DROP FOREIGN KEY FK_A6C013708805AB2F');
        $this->addSql('ALTER TABLE annonce_equipement DROP FOREIGN KEY FK_A6C01370806F0F5C');
        $this->addSql('ALTER TABLE categorie_equipement DROP FOREIGN KEY FK_267D0C5F806F0F5C');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849558805AB2F');
        $this->addSql('ALTER TABLE type_de_bien DROP FOREIGN KEY FK_4C6702148805AB2F');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6498805AB2F');
        $this->addSql('DROP TABLE annonce');
        $this->addSql('DROP TABLE annonce_equipement');
        $this->addSql('DROP TABLE categorie_equipement');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE type_de_bien');
        $this->addSql('DROP TABLE `user`');
    }
}
