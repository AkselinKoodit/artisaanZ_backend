<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210607100014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE seller (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nimi VARCHAR(60) NOT NULL, esittely CLOB NOT NULL, tuotteet CLOB DEFAULT NULL --(DC2Type:array)
        , username VARCHAR(30) DEFAULT NULL, password VARCHAR(30) DEFAULT NULL, password_check VARCHAR(30) DEFAULT NULL, tuotteita INTEGER DEFAULT NULL)');
        $this->addSql('DROP TABLE user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nimi VARCHAR(60) NOT NULL COLLATE BINARY, esittely CLOB NOT NULL COLLATE BINARY, tuotteet CLOB DEFAULT NULL COLLATE BINARY --(DC2Type:array)
        , username VARCHAR(30) DEFAULT NULL COLLATE BINARY, password VARCHAR(30) DEFAULT NULL COLLATE BINARY, password_check VARCHAR(30) DEFAULT NULL COLLATE BINARY, tuotteita INTEGER DEFAULT NULL)');
        $this->addSql('DROP TABLE seller');
    }
}
