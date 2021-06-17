<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615120749 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE follow DROP FOREIGN KEY FK_683444706BA58F3E');
        $this->addSql('ALTER TABLE follow DROP FOREIGN KEY FK_68344470D4E271E1');
        $this->addSql('ALTER TABLE follow ADD CONSTRAINT FK_6F984146D4E271E1 FOREIGN KEY (projet_id_id) REFERENCES projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE follow ADD CONSTRAINT FK_6F9841466BA58F3E FOREIGN KEY (personne_id_id) REFERENCES personne (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Follow DROP FOREIGN KEY FK_6F984146D4E271E1');
        $this->addSql('ALTER TABLE Follow DROP FOREIGN KEY FK_6F9841466BA58F3E');
        $this->addSql('ALTER TABLE Follow ADD CONSTRAINT FK_683444706BA58F3E FOREIGN KEY (personne_id_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE Follow ADD CONSTRAINT FK_68344470D4E271E1 FOREIGN KEY (projet_id_id) REFERENCES projet (id)');
    }
}
