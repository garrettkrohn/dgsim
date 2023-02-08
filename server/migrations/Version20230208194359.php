<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208194359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE hole_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE hole_hole_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE hole RENAME COLUMN id TO hole_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE hole_hole_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE hole_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP INDEX hole_pkey');
        $this->addSql('ALTER TABLE hole RENAME COLUMN hole_id TO id');
        $this->addSql('ALTER TABLE hole ADD PRIMARY KEY (id)');
    }
}
