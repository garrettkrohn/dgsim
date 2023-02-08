<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208194848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE tournament_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE tournament_tournament_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE tournament RENAME COLUMN id TO tournament_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE tournament_tournament_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE tournament_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP INDEX tournament_pkey');
        $this->addSql('ALTER TABLE tournament RENAME COLUMN tournament_id TO id');
        $this->addSql('ALTER TABLE tournament ADD PRIMARY KEY (id)');
    }
}
