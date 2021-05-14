<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210404064003 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet CHANGE date_adm date_adm DATETIME DEFAULT NULL, CHANGE date_rej date_rej DATETIME DEFAULT NULL, CHANGE creation_date creation_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE reception CHANGE creation_date creation_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE signal_commentaire CHANGE creation_date creation_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE signal_projet CHANGE creation_date creation_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE vote CHANGE creation_date creation_date DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet CHANGE date_adm date_adm DATE DEFAULT NULL, CHANGE date_rej date_rej DATE DEFAULT NULL, CHANGE creation_date creation_date DATE NOT NULL');
        $this->addSql('ALTER TABLE reception CHANGE creation_date creation_date DATE NOT NULL');
        $this->addSql('ALTER TABLE signal_commentaire CHANGE creation_date creation_date DATE NOT NULL');
        $this->addSql('ALTER TABLE signal_projet CHANGE creation_date creation_date DATE NOT NULL');
        $this->addSql('ALTER TABLE vote CHANGE creation_date creation_date DATE NOT NULL');
    }
}
