<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208191937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE archetype_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE archetype_archetype_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE archetype RENAME COLUMN id TO archetype_id');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT FK_98197A65732C6CC7');
        $this->addSql('ALTER TABLE player ALTER archetype_id DROP NOT NULL');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65732C6CC7 FOREIGN KEY (archetype_id) REFERENCES archetype (archetype_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE archetype_archetype_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE archetype_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE player DROP CONSTRAINT fk_98197a65732c6cc7');
        $this->addSql('ALTER TABLE player ALTER archetype_id SET NOT NULL');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT fk_98197a65732c6cc7 FOREIGN KEY (archetype_id) REFERENCES archetype (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP INDEX archetype_pkey');
        $this->addSql('ALTER TABLE archetype RENAME COLUMN archetype_id TO id');
        $this->addSql('ALTER TABLE archetype ADD PRIMARY KEY (id)');
    }
}
