<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526105930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, kuva, nimi, kuvaus, hinta, artisaani, kategoria FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, kuva CLOB NOT NULL COLLATE BINARY --(DC2Type:array)
        , nimi VARCHAR(40) NOT NULL COLLATE BINARY, kuvaus VARCHAR(255) NOT NULL COLLATE BINARY, hinta INTEGER NOT NULL, artisaani VARCHAR(50) NOT NULL COLLATE BINARY, kategoria VARCHAR(60) NOT NULL)');
        $this->addSql('INSERT INTO product (id, kuva, nimi, kuvaus, hinta, artisaani, kategoria) SELECT id, kuva, nimi, kuvaus, hinta, artisaani, kategoria FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__product AS SELECT id, kuva, nimi, kuvaus, hinta, artisaani, kategoria FROM product');
        $this->addSql('DROP TABLE product');
        $this->addSql('CREATE TABLE product (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, kuva CLOB NOT NULL --(DC2Type:array)
        , nimi VARCHAR(40) NOT NULL, kuvaus VARCHAR(255) NOT NULL, hinta INTEGER NOT NULL, artisaani VARCHAR(50) NOT NULL, kategoria VARCHAR(20) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO product (id, kuva, nimi, kuvaus, hinta, artisaani, kategoria) SELECT id, kuva, nimi, kuvaus, hinta, artisaani, kategoria FROM __temp__product');
        $this->addSql('DROP TABLE __temp__product');
    }
}
