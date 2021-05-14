<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210425025106 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD picture LONGBLOB DEFAULT NULL, ADD mime_type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE message ADD picture LONGBLOB DEFAULT NULL, ADD mime_type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE personne ADD nn INT NOT NULL, ADD is_verified TINYINT(1) DEFAULT \'0\', ADD picture LONGBLOB DEFAULT NULL, ADD mime_type VARCHAR(255) NOT NULL, CHANGE is_active is_active TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE projet ADD picture LONGBLOB DEFAULT NULL, ADD mime_type VARCHAR(255) NOT NULL, ADD nbr_vote_null INT DEFAULT NULL, ADD nbr_vote_contre INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP picture, DROP mime_type');
        $this->addSql('ALTER TABLE message DROP picture, DROP mime_type');
        $this->addSql('ALTER TABLE personne DROP nn, DROP is_verified, DROP picture, DROP mime_type, CHANGE is_active is_active TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE projet DROP picture, DROP mime_type, DROP nbr_vote_null, DROP nbr_vote_contre');
    }
}
