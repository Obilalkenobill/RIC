<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210425130257 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne ADD rectocarteid LONGBLOB DEFAULT NULL, ADD mime_typerectocarteid VARCHAR(255) DEFAULT NULL, ADD versocarteid LONGBLOB DEFAULT NULL, ADD mime_typeversocarteid VARCHAR(255) DEFAULT NULL, CHANGE picture photoverif LONGBLOB DEFAULT NULL, CHANGE mime_type mime_typephotoverif VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne ADD picture LONGBLOB DEFAULT NULL, ADD mime_type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP photoverif, DROP mime_typephotoverif, DROP rectocarteid, DROP mime_typerectocarteid, DROP versocarteid, DROP mime_typeversocarteid');
    }
}
