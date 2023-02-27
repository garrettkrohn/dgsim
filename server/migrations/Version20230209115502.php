<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230209115502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE player_update_logs_player_update_log_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE player_update_log_player_update_log_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE player_update_log (player_update_log_id INT NOT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, player_id INT NOT NULL, putt_increment INT NOT NULL, throw_power_increment INT NOT NULL, throw_accuracy_increment INT NOT NULL, scramble_increment INT NOT NULL, previous_bank INT NOT NULL, post_bank INT NOT NULL, PRIMARY KEY(player_update_log_id))');
        $this->addSql('DROP TABLE player_update_logs');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE player_update_log_player_update_log_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE player_update_logs_player_update_log_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE player_update_logs (player_update_log_id INT NOT NULL, update_time TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, player_id INT NOT NULL, putt_increment INT NOT NULL, throw_power_increment INT NOT NULL, throw_accuracy_increment INT NOT NULL, scramble_increment INT NOT NULL, previous_bank INT NOT NULL, post_bank INT NOT NULL, PRIMARY KEY(player_update_log_id))');
        $this->addSql('DROP TABLE player_update_log');
    }
}
