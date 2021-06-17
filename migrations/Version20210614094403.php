<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210614094403 extends AbstractMigration
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
        $this->addSql('CREATE UNIQUE INDEX assignment_unique ON follow (personne_id_id, projet_id_id)');
        $this->addSql('DROP INDEX idx_68344470d4e271e1 ON follow');
        $this->addSql('CREATE INDEX IDX_6F984146D4E271E1 ON follow (projet_id_id)');
        $this->addSql('DROP INDEX idx_683444706ba58f3e ON follow');
        $this->addSql('CREATE INDEX IDX_6F9841466BA58F3E ON follow (personne_id_id)');
        $this->addSql('ALTER TABLE follow ADD CONSTRAINT FK_683444706BA58F3E FOREIGN KEY (personne_id_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE follow ADD CONSTRAINT FK_68344470D4E271E1 FOREIGN KEY (projet_id_id) REFERENCES projet (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX assignment_unique ON Follow');
        $this->addSql('ALTER TABLE Follow DROP FOREIGN KEY FK_6F984146D4E271E1');
        $this->addSql('ALTER TABLE Follow DROP FOREIGN KEY FK_6F9841466BA58F3E');
        $this->addSql('DROP INDEX idx_6f9841466ba58f3e ON Follow');
        $this->addSql('CREATE INDEX IDX_683444706BA58F3E ON Follow (personne_id_id)');
        $this->addSql('DROP INDEX idx_6f984146d4e271e1 ON Follow');
        $this->addSql('CREATE INDEX IDX_68344470D4E271E1 ON Follow (projet_id_id)');
        $this->addSql('ALTER TABLE Follow ADD CONSTRAINT FK_6F984146D4E271E1 FOREIGN KEY (projet_id_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE Follow ADD CONSTRAINT FK_6F9841466BA58F3E FOREIGN KEY (personne_id_id) REFERENCES personne (id)');
    }
}
