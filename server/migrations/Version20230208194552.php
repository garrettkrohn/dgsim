<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230208194552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE player_update_logs_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE player_update_logs_player_update_log_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE player_update_logs RENAME COLUMN id TO player_update_log_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE player_update_logs_player_update_log_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE player_update_logs_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP INDEX player_update_logs_pkey');
        $this->addSql('ALTER TABLE player_update_logs RENAME COLUMN player_update_log_id TO id');
        $this->addSql('ALTER TABLE player_update_logs ADD PRIMARY KEY (id)');
    }
}
