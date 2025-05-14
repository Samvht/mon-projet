<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250514105241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_497DD634FF7747B4 ON categorie (titre)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_7D053A93FF7747B4 ON menu (titre)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_14B78418C4222328 ON photo (chemin)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_2038A207FF7747B4 ON plat (titre)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_EB95123F6C6E55B5 ON restaurant (nom)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_497DD634FF7747B4 ON categorie
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_14B78418C4222328 ON photo
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_7D053A93FF7747B4 ON menu
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_8D93D649E7927C74 ON user
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_2038A207FF7747B4 ON plat
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_EB95123F6C6E55B5 ON restaurant
        SQL);
    }
}
