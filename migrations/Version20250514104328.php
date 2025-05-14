<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514104328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(64) NOT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT NOT NULL, titre VARCHAR(64) NOT NULL, description LONGTEXT DEFAULT NULL, prix NUMERIC(2, 2) NOT NULL, date_creation DATETIME NOT NULL, INDEX IDX_7D053A93B1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE menu_categorie (id INT AUTO_INCREMENT NOT NULL, menu_id INT NOT NULL, cayegorie_id INT NOT NULL, INDEX IDX_503DB100CCD7E912 (menu_id), INDEX IDX_503DB100490B6C9D (cayegorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, restaurant_id INT NOT NULL, titre VARCHAR(128) NOT NULL, chemin VARCHAR(128) NOT NULL, date_creation DATETIME NOT NULL, INDEX IDX_14B78418B1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE plat (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(64) NOT NULL, description LONGTEXT DEFAULT NULL, prix NUMERIC(5, 2) NOT NULL, date_creation DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE plat_categorie (id INT AUTO_INCREMENT NOT NULL, plat_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_B5FAB76ED73DB560 (plat_id), INDEX IDX_B5FAB76EBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, restaurant_id INT NOT NULL, nbre_convive SMALLINT NOT NULL, date_reservation DATE NOT NULL, heure_reservation DATETIME NOT NULL, allergies VARCHAR(255) DEFAULT NULL, date_creation DATETIME NOT NULL, INDEX IDX_42C84955A76ED395 (user_id), INDEX IDX_42C84955B1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, proprietaire_id INT NOT NULL, nom VARCHAR(32) NOT NULL, descritpion LONGTEXT DEFAULT NULL, heure_ouverture_matin JSON NOT NULL, heure_ouverture_soir JSON NOT NULL, nbre_max_couverts SMALLINT NOT NULL, date_creation DATETIME NOT NULL, UNIQUE INDEX UNIQ_EB95123F76C50E4A (proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu ADD CONSTRAINT FK_7D053A93B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_categorie ADD CONSTRAINT FK_503DB100CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_categorie ADD CONSTRAINT FK_503DB100490B6C9D FOREIGN KEY (cayegorie_id) REFERENCES categorie (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE photo ADD CONSTRAINT FK_14B78418B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE plat_categorie ADD CONSTRAINT FK_B5FAB76ED73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE plat_categorie ADD CONSTRAINT FK_B5FAB76EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F76C50E4A FOREIGN KEY (proprietaire_id) REFERENCES user (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93B1E7706E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_categorie DROP FOREIGN KEY FK_503DB100CCD7E912
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE menu_categorie DROP FOREIGN KEY FK_503DB100490B6C9D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE photo DROP FOREIGN KEY FK_14B78418B1E7706E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE plat_categorie DROP FOREIGN KEY FK_B5FAB76ED73DB560
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE plat_categorie DROP FOREIGN KEY FK_B5FAB76EBCF5E72D
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955B1E7706E
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123F76C50E4A
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE categorie
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE menu
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE menu_categorie
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE photo
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE plat
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE plat_categorie
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reservation
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE restaurant
        SQL);
    }
}
