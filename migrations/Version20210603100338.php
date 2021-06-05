<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210603100338 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE RolePers (id INT AUTO_INCREMENT NOT NULL, personne_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_702F1D59A21BD112 (personne_id), INDEX IDX_702F1D59D60322AC (role_id), UNIQUE INDEX assignment_unique (personne_id, role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE RolePers ADD CONSTRAINT FK_702F1D59A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE RolePers ADD CONSTRAINT FK_702F1D59D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('DROP TABLE role_pers');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE role_pers (id INT AUTO_INCREMENT NOT NULL, personne_id_id INT NOT NULL, role_id_id INT NOT NULL, INDEX IDX_6EDD3F2D6BA58F3E (personne_id_id), INDEX IDX_6EDD3F2D88987678 (role_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE role_pers ADD CONSTRAINT FK_6EDD3F2D6BA58F3E FOREIGN KEY (personne_id_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE role_pers ADD CONSTRAINT FK_6EDD3F2D88987678 FOREIGN KEY (role_id_id) REFERENCES role (id)');
        $this->addSql('DROP TABLE RolePers');
    }
}
